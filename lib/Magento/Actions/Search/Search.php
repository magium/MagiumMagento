<?php

namespace Magium\Magento\Actions\Search;

use Magium\Actions\WaitForPageLoaded;
use Magium\Magento\Themes\AbstractThemeConfiguration;
use Magium\WebDriver\WebDriver;

class Search
{
    const ACTION = 'Search\Search';

    protected $webDriver;
    protected $theme;
    protected $loaded;

    public function __construct(
        AbstractThemeConfiguration $theme,
        WebDriver $webDriver,
        WaitForPageLoaded $loaded)
    {
        $this->theme = $theme;
        $this->webDriver = $webDriver;
        $this->loaded = $loaded;
    }

    public function search($characters)
    {
        $this->type($characters);
        $element = $this->webDriver->byXpath($this->theme->getSearchSubmitXpath());
        $element->click();
        $this->loaded->execute($element);
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