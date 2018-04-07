<?php

namespace Orba\CurrencyConverter\Model\Converter;

interface RateProviderInterface
{
    /**
     * @param string $fromCurrency
     * @param string $toCurrency
     * @return float
     */
    public function getRate($fromCurrency, $toCurrency);
}
