<?php

namespace Orba\CurrencyConverter\Model;

class Converter implements ConverterInterface
{
    /**
     * @var Converter\RateProviderListInterface
     */
    private $rateProviderList;

    /**
     * @param Converter\RateProviderListInterface $rateProviderList
     */
    public function __construct(
        Converter\RateProviderListInterface $rateProviderList
    ) {
        $this->rateProviderList = $rateProviderList;
    }

    /**
     * {@inheritdoc}
     */
    public function convert($provider, $fromCurrency, $toCurrency, $amount)
    {
        $providers = $this->rateProviderList->getProviders();

        if (!isset($providers[$provider])) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Invalid currency rate provider.'));
        }

        $rate = $providers[$provider]->getRate($fromCurrency, $toCurrency);

        return $amount * $rate;
    }
}
