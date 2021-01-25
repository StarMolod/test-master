<?php

namespace App\Http\Controllers;

use App\Models\SearchResult;
use App\Models\SearchRow;
use App\Services\Parser\YandexParser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class SearchController extends Controller
{
    public function index(Request $request){
        return view('welcome');
    }

    public function search(Request $request, YandexParser $yandexParser){
        $query = $request->get('q') ;

        $results = [];
        if(!empty($query)) {
            $searchResult = new SearchResult();
            $searchResult->key = $query;
            $searchResult->save();

            $url = sprintf("https://yandex.ru/search/?lr=2&text=%s", $query);
            $response = Http::get($url);
            $results = $yandexParser->getLinks($response->body(), $query);

            foreach ($results as $result){
                $searchRow = new SearchRow();
                $searchRow->link = $result['link'];
                $searchRow->words = json_encode($result['words']);
                $searchRow->searchResult()->associate($searchResult);
                $searchRow->save();
            }
        }

        return view('result', [
            'searchString'=>$query,
            'items'=>$results
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function history(){
        $searchResults = SearchResult::query()->get();

        return view('search_history', ['items'=>$searchResults]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function historyRow($id){
        $searchResult = SearchResult::with('rows')->find($id);
        $results = [];

        foreach ($searchResult->rows as $searchResult){
            $results[] = [
                'words'=>json_decode($searchResult->words),
                'link'=>$searchResult->link
            ];
        }

        return view('result', [
            'searchString'=>$searchResult->key,
            'items'=>$results
        ]);
    }
}
