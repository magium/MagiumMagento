<?php

namespace Magium\Magento\Extractors\Admin\Widget;

use Facebook\WebDriver\WebDriverElement;
use Magium\AbstractTestCase;
use Magium\Extractors\AbstractExtractor;
use Magium\Magento\InvalidFormatException;
use Magium\Magento\Navigators\Admin\Widget\Tab;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\WebDriver;

class Attribute extends AbstractExtractor
{
    const EXTRACTOR = 'Admin\Widget\Attribute';

    protected $element;
    protected $label;
    protected $navigator;

    public function __construct(
        WebDriver $webDriver,
        AbstractTestCase $testCase,
        ThemeConfiguration $theme,
        Tab $navigator
        )
    {
        parent::__construct($webDriver, $testCase, $theme);
        $this->navigator = $navigator;
    }

    /**
     * @param $label
     * @return WebDriverElement
     */

    public function getElementByLabel($label)
    {
        $label = explode('::', $label);
        if (count($label) > 2) {
            throw new InvalidFormatException('The label must have two or fewer components');
        } else if (count($label) == 2) {
            $this->navigator->navigateTo(array_shift($label));
        }
        $this->label = array_shift($label);
        $this->extract();
        return $this->element;
    }

    public function extract()
    {
        $xpath = $this->theme->getWidgetAttributeByLabelXpath($this->label);
        $this->element = $this->webDriver->byXpath($xpath);
    }

}