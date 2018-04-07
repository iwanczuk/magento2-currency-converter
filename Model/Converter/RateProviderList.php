<?php

namespace Orba\CurrencyConverter\Model\Converter;

class RateProviderList implements RateProviderListInterface
{
    /**
     * @var \Orba\CurrencyConverter\Model\Converter\RateProviderInterface[]
     */
    protected $providers;

    /**
     * @param \Orba\CurrencyConverter\Model\Converter\RateProviderInterface[] $providers
     */
    public function __construct(array $providers = [])
    {
        $this->providers = $providers;
    }

    /**
     * {@inheritdoc}
     */
    public function getProviders()
    {
        return $this->providers;
    }
}
