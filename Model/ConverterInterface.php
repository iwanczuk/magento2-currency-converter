<?php

namespace Orba\CurrencyConverter\Model;

interface ConverterInterface
{
    /**
     * @param string $provider
     * @param string $fromCurrency
     * @param string $toCurrency
     * @param float $amount
     * @return float
     */
    public function convert($provider, $fromCurrency, $toCurrency, $amount);
}
