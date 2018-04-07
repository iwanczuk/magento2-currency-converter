<?php

namespace Orba\CurrencyConverter\Model\Converter\RateProvider;

use Magento\Framework\Exception\LocalizedException;

class FixerIoRateProvider implements \Orba\CurrencyConverter\Model\Converter\RateProviderInterface
{
    const API_ENDPOINT = 'http://api.fixer.io/latest?base=%s&symbols=%s';

    /**
     * @var \Magento\Framework\HTTP\ClientFactory
     */
    protected $clientFactory;

    /**
     * @var \Magento\Framework\Json\DecoderInterface
     */
    protected $decoder;

    /**
     * @param \Magento\Framework\HTTP\ClientFactory $clientFactory
     * @param \Magento\Framework\Json\DecoderInterface $decoder
     */
    public function __construct(
        \Magento\Framework\HTTP\ClientFactory $clientFactory,
        \Magento\Framework\Json\DecoderInterface $decoder
    ) {
        $this->clientFactory = $clientFactory;
        $this->decoder = $decoder;
    }

    /**
     * {@inheritdoc}
     */
    public function getRate($fromCurrency, $toCurrency)
    {
        $currencyCodes = $this->getSupportedCurrencyCodes();

        if (!in_array($fromCurrency, $currencyCodes)) {
            throw new LocalizedException(__('Unsupported base currency.'));
        }

        if (!in_array($toCurrency, $currencyCodes)) {
            throw new LocalizedException(__('Unsupported destination currency.'));
        }

        $client = $this->clientFactory->create();

        try {
            $client->get(sprintf(self::API_ENDPOINT, $fromCurrency, $toCurrency));

            $result = $this->decoder->decode($client->getBody());
        } catch (\Exception $e) {
            throw new LocalizedException(__('Currency rate provider service is unavailable.'));
        }

        if (!isset($result['rates'][$toCurrency])) {
            throw new LocalizedException(__('Invalid currency rate provider response.'));
        }

        return $result['rates'][$toCurrency];
    }

    /**
     * @return string[]
     */
    private function getSupportedCurrencyCodes()
    {
        return [
            \Orba\CurrencyConverter\Model\CurrencyInterface::CURRENCY_PLN,
            \Orba\CurrencyConverter\Model\CurrencyInterface::CURRENCY_RUB
        ];
    }
}
