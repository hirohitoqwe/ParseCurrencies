<?php

namespace Controller;

use Components\SourceData;
use DB\DB;
use http\Header;

class CurrencyController
{

    public function __construct(private readonly array $request, private readonly DB $db)
    {
    }

    public function getConverted()
    {
        return $this->convertCurrency();
    }

    private function convertCurrency()
    {
        if (isset($this->request["TR"])) {
            $course = $this->db->getParticularCurrency($this->request['TR']);
            return doubleval($this->request["count"] * $course);
        } elseif (isset($this->request["FR"])) {
            $course = $this->db->getParticularCurrency($this->request['FR']);
            return doubleval($this->request["count"] / $course);
        }
    }

    public static function refreshCurrencies($db): bool
    {
        if ($db->refreshCurrencies()) {
            $data = new SourceData();
            $db->insertCurrencies($data->getCurrenciesData());
            return true;
        }
        return false;
    }
}