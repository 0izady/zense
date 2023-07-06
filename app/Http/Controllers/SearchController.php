<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use App\Models\History;
use App\Models\PopularSearchs;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class SearchController extends Controller
{
    public function show($key_word)
    {

        // save history
        if (Auth::user()) {
            if (!History::where('user_id', Auth::id())->where('search_text', $key_word)->first()) {
                History::create([
                    'search_text' => $key_word,
                    'user_id' => Auth::id()
                ]);
            }
        }

        // $cach = Cache::get($key_word);
        // if ($cach) {
        //     return Inertia::render('Search', [
        //         "summarize" => $cach["summarize"],
        //         "article" => $cach["article"],
        //         "img" => $cach["img_src"],
        //         "okay" => $cach["key_word"],
        //     ]);

        // }

        // // set $key_word to array , for confirm inertia
        // $ok = [$key_word];
        // // brows keys
        // $open_ai = new OpenAI("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");
        // DetectLanguage::setApiKey("dd31506418887e4a23c11650c3367dd4");
        // // get lang code
        // $languageCode = DetectLanguage::simpleDetect($key_word);
        // // requst to wikipedia
        // $wiki = Http::get("https://" . $languageCode . ".wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro&explaintext&redirects=1&titles=" . $key_word)->json()['query']['pages'];
        // $wiki_result = array_values($wiki)[0];
        // // requst to get img wikipedia
        // $wikiImage = Http::get("https://" . $languageCode . ".wikipedia.org/w/api.php?action=query&prop=pageimages&format=json&piprop=original&titles=" . $key_word)->json()['query']['pages'];
        // $wikiImage_result = array_values($wikiImage)[0];
        // // if subject not in wiki pedia extract text is: key word
        // if (!array_key_exists("extract", $wiki_result)) {
        //     $wiki_result["extract"] = $key_word;
        // }

        // // if subject not in wiki pedia images original image is: our logo
        // if (!array_key_exists("original", $wikiImage_result)) {
        //     $wikiImage_result['original'] = ["source" => "/img/azar.png"];
        // }

        // // set wiki_result to extracted text
        // $wiki_result = $wiki_result["extract"];

        // // if wiki result is to long we make it small
        // if (strlen($wiki_result) > 390) {
        //     $split = explode('.', $wiki_result);
        //     $wiki_result = $split[0];
        //     if ($wiki_result > 390) {
        //         $wiki_result = substr($wiki_result, 0, 300);
        //     }
        // }

        // // make requset text
        // if ($languageCode == "fa") {
        //     $content_summarize = "توضیحی ای در مورد این متن ارائه دهید. متن: " . $wiki_result;
        //     $content_articel = "مقاله ای در مورد : " . $wiki_result;
        // } else {
        //     $content_summarize = "explanation of this text . text is: " . $wiki_result;
        //     $content_articel = "Write an article about" . $wiki_result;
        // }

        // // make summarize request
        // $summarize_chat = $open_ai->chat([
        //     'model' => 'gpt-3.5-turbo',
        //     'messages' => [
        //         [
        //             "role" => "user",
        //             "content" => $content_summarize
        //         ],
        //     ],
        //     'temperature' => 1.0,
        //     // 'max_tokens' => 4000,
        //     'frequency_penalty' => 0,
        //     'presence_penalty' => 0,
        // ]);
        // $summarize_data = json_decode($summarize_chat, true);
        // $summarize = $summarize_data['choices'][0];
        // // make article request
        // $article_chat = $open_ai->chat([
        //     'model' => 'gpt-3.5-turbo',
        //     'messages' => [
        //         [
        //             "role" => "user",
        //             "content" => $content_articel
        //         ],
        //     ],
        //     'temperature' => 1.0,
        //     // 'max_tokens' => 4000,
        //     'frequency_penalty' => 0,
        //     'presence_penalty' => 0,
        // ]);
        // $article_data = json_decode($article_chat, true);
        // $article = $article_data['choices'][0];

        // // get popular searches if this key word is in databse,
        // // plus one to views and if not make it and set views to one
        // $popularPost = PopularSearchs::where('key_word', $key_word)->first();
        // if ($popularPost) {
        //     $views = $popularPost->views;
        //     $popularPost->update([
        //         "views" => $views + 1
        //     ]);
        // } else {
        //     PopularSearchs::create([
        //         "key_word" => $key_word,
        //         "text" => implode(' ', array_slice(explode(' ', $summarize["message"]["content"]), 0, 10)),
        //         "img_src" => $wikiImage_result['original']["source"],
        //         "views" => 1
        //     ]);
        // }


        // // save cach
        // $data = [
        //     "key_word" => $key_word,
        //     "summarize" => $summarize["message"]["content"],
        //     "article" => $article["message"]["content"],
        //     "img_src" => $wikiImage_result['original']["source"]
        // ];
        // Cache::add($key_word, $data, now()->addHours(24));


        // $result = Http::get(url("/api/search/$key_word"))->json();
        // dd(Http::get(route('api.search', ['key_word' => $key_word])));

        // return view
        return Inertia::render('Search', [
            "key_word" => $key_word,
        ]);
    }


    public function top()
    {

        // we can do that too
        $date = Carbon::today()->subDays(7);
        $searches = PopularSearchs::where('created_at', '>=', $date)->orderBy('views', 'desc')->take(10)->get();

        return Inertia::render('Top', [
            "tops" => $searches
        ]);
    }
}
