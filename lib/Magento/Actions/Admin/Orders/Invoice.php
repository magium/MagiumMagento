<?php

namespace Magium\Magento\Actions\Admin\Orders;

use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

class Invoice
{

    const ACTION = 'Admin\Orders\Invoice';

    protected $webDriver;
    protected $themeConfiguration;

    protected $preExecuteActions = [];

    /**
     * Invoice constructor.
     * @param $webDriver
     * @param $themeConfiguration
     */
    public function __construct(
        WebDriver $webDriver,
        ThemeConfiguration $themeConfiguration)
    {
        $this->webDriver = $webDriver;
        $this->themeConfiguration = $themeConfiguration;
    }

    public function addPreExecuteAction(PreExecuteActionInterface $action)
    {
        $this->preExecuteActions[] = $action;
    }

    /**
     * This test presumes that you are on the order screen
     */

    public function invoice()
    {
        foreach ($this->preExecuteActions as $action) {
            if ($action instanceof PreExecuteActionInterface) {
                $action->execute();
            }
        }
    }

}