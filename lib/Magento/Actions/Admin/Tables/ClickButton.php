<?php


namespace Magium\Magento\Actions\Admin\Tables;

use Magium\Actions\ConfigurableActionInterface;
use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

class ClickButton implements ConfigurableActionInterface
{

    const ACTION = 'Admin\Tables\ClickButton';

    protected $webDriver;
    protected $theme;
    protected $testCase;

    public function __construct(
        WebDriver                   $webDriver,
        ThemeConfiguration     $theme,
        AbstractMagentoTestCase     $testCase
    )
    {
        $this->webDriver                = $webDriver;
        $this->theme                    = $theme;
        $this->testCase                 = $testCase;
    }

    public function click($text)
    {
        $elementXpath = $this->theme->getTableButtonXpath($text);

        $this->webDriver->byXpath($elementXpath)->click();

    }

    public function execute($param)
    {
        $this->click($param);
    }

}