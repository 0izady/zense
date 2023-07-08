<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\PopularPosts;
use App\Models\PopularSearchs;
use App\Models\Post;
use App\Models\Search;
use Illuminate\Database\Eloquent\Casts\Json;
use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Cache;
use \DetectLanguage\DetectLanguage;
use Illuminate\Support\Facades\Http;



class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function post()
    {
        $resources = Post::all();
        return response()->json($resources);
    }
    public function searches()
    {
        $resources = Cache::all();
        return response()->json($resources);
    }

    public function GetSearch($name)
    {
        $resources = Cache::get($name);
        return response()->json($resources);
    }

    public function history()
    {
        $resources = History::all();
        return response()->json($resources);
    }
    public function PupularPost()
    {
        $resources = PopularPosts::all();
        return response()->json($resources);
    }

    public function PopularSearch()
    {
        $resources = PopularSearchs::all();
        return response()->json($resources);
    }

    public function GetPost($name)
    {
        $resources = Post::where('title', $name)->get();
        return response()->json($resources);
    }

    public function chat($text)
    {
        // brows keys
        $open_ai = new OpenAI("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");

        // make chat
        $chat = $open_ai->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    "role" => "user",
                    "content" => "$text"
                ],
            ],
            'temperature' => 1.0,
            // 'max_tokens' => 4000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);
        $chat_data = json_decode($chat, true);
        $result = $chat_data['choices'][0];
        $resources = $result["message"]["content"];

        return response()->json($resources);
    }

    public function translate($lan, $text)
    {
        $tr = new GoogleTranslate();
        $tr->setTarget($lan);
        $resources = $tr->translate($text);

        return response()->json($resources);
    }

    public function search($key_word)
    {
        $cache = Cache::get($key_word);
        if ($cache) {
            $resources = [
                "summarize" => $cache["summarize"],
                "article" => $cache["article"],
                "img" => $cache["img_src"],
                "okay" => $cache["key_word"],
            ];
            return response()->json($resources);
        }

        // set $key_word to array , for confirm inertia
        $ok = [$key_word];
        // brows keys
        $open_ai = new OpenAI("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");
        DetectLanguage::setApiKey("dd31506418887e4a23c11650c3367dd4");
        // get lang code
        $languageCode = DetectLanguage::simpleDetect($key_word);
        // requst to wikipedia
        $wiki = Http::get("https://" . $languageCode . ".wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro&explaintext&redirects=1&titles=" . $key_word)->json()['query']['pages'];
        $wiki_result = array_values($wiki)[0];
        // requst to get img wikipedia
        $wikiImage = Http::get("https://" . $languageCode . ".wikipedia.org/w/api.php?action=query&prop=pageimages&format=json&piprop=original&titles=" . $key_word)->json()['query']['pages'];
        $wikiImage_result = array_values($wikiImage)[0];
        // if subject not in wiki pedia extract text is: key word
        if (!array_key_exists("extract", $wiki_result)) {
            $wiki_result["extract"] = $key_word;
        }

        // if subject not in wiki pedia images original image is: our logo
        if (!array_key_exists("original", $wikiImage_result)) {
            $wikiImage_result['original'] = ["source" => "/img/azar.png"];
        }

        // set wiki_result to extracted text
        $wiki_result = $wiki_result["extract"];

        // if wiki result is to long we make it small
        if (strlen($wiki_result) > 390) {
            $split = explode('.', $wiki_result);
            $wiki_result = $split[0];
            if ($wiki_result > 390) {
                $wiki_result = substr($wiki_result, 0, 300);
            }
        }

        // make requset text
        if ($languageCode == "fa") {
            $content_summarize = "توضیحی ای در مورد این متن ارائه دهید. متن: " . $wiki_result;
            $content_articel = "مقاله ای در مورد : " . $wiki_result;
        } else {
            $content_summarize = "explanation of this text . text is: " . $wiki_result;
            $content_articel = "Write an article about" . $wiki_result;
        }

        // make summarize request
        $summarize_chat = $open_ai->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    "role" => "user",
                    "content" => $content_summarize
                ],
            ],
            'temperature' => 1.0,
            // 'max_tokens' => 4000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);
        $summarize_data = json_decode($summarize_chat, true);
        $summarize = $summarize_data['choices'][0];
        // make article request
        $article_chat = $open_ai->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    "role" => "user",
                    "content" => $content_articel
                ],
            ],
            'temperature' => 1.0,
            // 'max_tokens' => 4000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);
        $article_data = json_decode($article_chat, true);
        $article = $article_data['choices'][0];


        // get popular searches if this key word is in databse,
        // plus one to views and if not make it and set views to one
        $popularPost = PopularSearchs::where('key_word', $key_word)->first();
        if ($popularPost) {
            $views = $popularPost->views;
            $popularPost->update([
                "views" => $views + 1
            ]);
        } else {
            PopularSearchs::create([
                "key_word" => $key_word,
                "text" => implode(' ', array_slice(explode(' ', $summarize["message"]["content"]), 0, 10)),
                "img_src" => $wikiImage_result['original']["source"],
                "views" => 1
            ]);
        }

        $resources = [
            "key_word" => $key_word,
            "summarize" => $summarize["message"]["content"],
            "article" => $article["message"]["content"],
            "img_src" => $wikiImage_result['original']["source"]
        ];

        Cache::add($key_word, $resources, now()->addHours(24));

        return response()->json($resources);
    }
}
