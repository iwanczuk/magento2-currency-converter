<?php

namespace Orba\CurrencyConverter\Block\Converter;

class Form extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\Json\EncoderInterface
     */
    protected $_jsonEncoder;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param mixed $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        array $data = []
    ) {
        $this->_jsonEncoder = $jsonEncoder;
        parent::__construct(
            $context,
            $data
        );
    }

    /**
     * @return string
     */
    public function getOptionsJson()
    {
        return $this->_jsonEncoder->encode(['url' => $this->getUrl('currencyconverter/converter/convert')]);
    }
}
