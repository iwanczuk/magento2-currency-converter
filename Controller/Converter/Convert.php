<?php

namespace Orba\CurrencyConverter\Controller\Converter;

class Convert extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Orba\CurrencyConverter\Model\ConverterInterface
     */
    protected $converter;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Orba\CurrencyConverter\Model\ConverterInterface $converter
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Orba\CurrencyConverter\Model\ConverterInterface $converter
    ) {
        $this->converter = $converter;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $resultJson = $this->resultFactory
            ->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);

        $fromCurrency = $this->getRequest()->getParam('from_currency');
        $fromAmount = $this->getRequest()->getParam('from_amount');
        $toCurrency = $this->getRequest()->getParam('to_currency');

        try {
            $toAmount = $this->converter->convert(
                'fixerio',
                $fromCurrency,
                $toCurrency,
                $fromAmount
            );

            $resultJson->setData(['error' => false, 'to_amount' => $toAmount]);
        } catch (\Exception $e) {
            $resultJson->setData(['error' => true, 'message' => $e->getMessage()]);
        }

        return $resultJson;
    }
}
