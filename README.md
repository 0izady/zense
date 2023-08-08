# zenes
zenes is a searcher powered by AI <br /><br />
What does zenes do? <br /><br />
first, on the home page, you search for some keyword <br />
and then zenes first searches it on Wikipedia and get some article and image about that <br />
and then we ask chat GPT to get us some summary and articles about things we got on Wikipedia <br />
and instead of searching for a topic on several sites, the user can find general information about it on our website<br /><br />

And with this, you can save time and easily get information about your subject <br /><br />

After all these tasks, the keyword, the address of the photo we got from Wikipedia, and the number of search visits are stored in the database, and a cache of search results that includes a summary of the text, article, and photo is stored for up to 24 hours.

![home](https://github.com/ezady/zense/blob/24ebb79d762f258765454302fa105cd0bf1b4f22/screen%20shot/home.png)
## Builders
### Arshiamohammadei [@Arshiamohammadei85][1]
[1]: https://github.com/arshiamohammadei85
Other sections:
* API
* Make post
* Dashboard
* Documentation
* Top posts
* Top searches
* About us
* Contact us

## API ##
In the api section, we offer:
* `/api/searches` : To get all the searches done in the program
* `/api/top_search` : To get top searches on week
* `/api/GetSearch/{key_word}` : To get a specific search whose cache is available <br /> we use this in the home page to Ajax get search , for example, somebody searches apple and cache is available and next when you type apple in home page you do not need to go to search page and you can see summery about that on home page
* `/api/search/{key_word}` : It searches for the keyword in Wikipedia and chat GPT. The main task of the program <br />
we use this on the search page for example when you search apple you are redirected to the search page and in the search page we use Axios to request this API and return results
* `/api/postes` : To get all posts in app
* `/api//top_post` : To get top posts on week
* `/api//post/{name}` : Get a specific post
* `/api/chat/{text}` : chat whit chat GPT <br />
We use this on the post creation page so that if you don't know something, chat GPT will explain it in your text. <br />
For example, you are writing a post about the Milky Way, but in a part of the text you need to explain a little about the solar system, but you don't know it, don't worry, chat GPT will help you and explain it in your text.
* `/api/translate/{language}/{text}` : to translate some text whit GoogleTranslate <br />
We use this on the search page so you can translate search results into different languages

## Make post ##
You can create content on various topics and if you encounter a problem, chat GPT will help you

## Dashboard ## 
in the dashboard, you can make posts, search, read the documentation, and edit your profile

## Documentation ##
Application api documentation

## Top posts ##
see the top posts of the week and if you like read it

## Top searches ##
see the top searches of the week and if you like read it

## About us ##
Information about the program and its developer

## Contact us ##
Ways of communication with the developer


<br /><br />
To see sample photos from the program, please go to the screenshot directory
<br /><br />
### note ###
in /app/Http/Controllers/ApiController.php on line 67,115 push your open AI API keys
