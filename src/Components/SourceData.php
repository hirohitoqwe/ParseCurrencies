<?php

class SourceData
{
    const url = 'https://www.cbr.ru/currency_base/daily/';

    public function __construct(private readonly string $url)
    {
    }

    public function getData(): string|false
    {
        return file_get_contents(self::url);
        //return file_get_contents($this->url);
    }
}