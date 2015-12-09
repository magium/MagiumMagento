<?php

namespace Magium\Magento\Actions\Checkout\Steps;



class StopProcessing implements StepInterface
{

    public function execute()
    {
        return false;
    }
}