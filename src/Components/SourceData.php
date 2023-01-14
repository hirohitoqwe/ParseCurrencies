<?php

namespace Components;

use Symfony\Component\DomCrawler\Crawler;

class SourceData
{
    const url = 'https://www.cbr.ru/currency_base/daily/';

    public function getSourceData(): string|false
    {
        return file_get_contents(self::url);
    }

    public function getCurrenciesData(): array|false
    {
        $crawler = new Crawler($this->getSourceData());

        if ($this->getSourceData()) {
            $table = $crawler->filter('table')->filter('tr')->each(function ($tr, $i) {
                return $tr->filter('td')->each(function ($td, $i) {
                    return trim($td->text());
                });
            });
            return array_slice($table,1);
        }
        return false;
    }

}