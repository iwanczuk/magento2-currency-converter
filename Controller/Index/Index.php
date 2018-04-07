<?php

namespace Orba\CurrencyConverter\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('currencyconverter/converter/form');
    }
}
