<?php

namespace App\Services\Parser;

use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class YandexParser
 * @package App\Services\Parser
 */
class YandexParser
{
    /**
     * @param $html
     */
    public function getLinks($html, $key){
        $parser = new Crawler($html);
        $items = $parser->filter('a.link.link_theme_normal.organic__url.link_cropped_no.i-bem')->each(function (Crawler $node, $i) use ($key) {
            $links = $node->filter('.organic__url-text');

            $link = $node->attr('href');
            $subHtml = Http::get($link);
            // Вывод — Подстрока "5 лет" есть в данной строке.
            preg_match_all('/' . $key .  '/', $subHtml, $array);
            return [
                'name'=>$links->text(),
                'words'=>array_slice(array_unique($array[0] ?? $this->getWords($links)), 0, 5),
                'link'=>$link
            ];
        });

        return array_slice($items, 0, 10);
    }

    /**
     * @param $links
     * @return mixed
     */
    protected function getWords($links){
        return $links->filter('b')->each(function ($node, $i){
            return $node->text();
        });
    }
}
