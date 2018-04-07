<?php

namespace Orba\CurrencyConverter\Controller\Converter;

class Form extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultFactory
            ->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);

        return $resultPage;
    }
}
