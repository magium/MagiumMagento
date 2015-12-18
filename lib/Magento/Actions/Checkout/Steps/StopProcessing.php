<?php

namespace Magium\Magento\Actions\Checkout\Steps;



class StopProcessing implements StepInterface
{
    const ACTION = 'Checkout\Steps\StopProcessing';

    public function execute()
    {
        return false;
    }
}