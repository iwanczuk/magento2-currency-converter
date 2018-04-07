<?php

namespace Orba\CurrencyConverter\Model\Converter;

interface RateProviderListInterface
{
    /**
     * @return \Orba\CurrencyConverter\Model\Converter\RateProviderInterface[]
     */
    public function getProviders();
}
