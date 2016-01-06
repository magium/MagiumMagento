<?php

namespace Magium\Magento\Actions\Search;

use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class Search
{
    const ACTION = 'Search\Search';

    protected $webDriver;
    protected $theme;

    public function __construct(
        AbstractThemeConfiguration $theme,
        WebDriver $webDriver)
    {
        $this->theme = $theme;
        $this->webDriver = $webDriver;
    }

    public function search($characters)
    {
        $this->type($characters);
        $this->webDriver->byXpath($this->theme->getSearchSubmitXpath())->click();
    }

    public function type($characters, $clear = false)
    {
        $box = $this->webDriver->byXpath($this->theme->getSearchInputXpath());
        if ($clear) {
            $box->clear();
        }
        $box->sendKeys($characters);
    }

}