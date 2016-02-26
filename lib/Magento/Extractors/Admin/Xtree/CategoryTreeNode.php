<?php

namespace Magium\Magento\Extractors\Admin\Xtree;

use Facebook\WebDriver\Exception\ElementNotVisibleException;
use Facebook\WebDriver\WebDriverElement;
use Magium\AbstractTestCase;
use Magium\Extractors\AbstractExtractor;
use Magium\InvalidInstructionException;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\WebDriver\ExpectedCondition;
use Magium\WebDriver\WebDriver;

class CategoryTreeNode extends AbstractExtractor
{

    const EXTRACTOR = 'Admin\Xtree\CategoryTreeNode';

    protected $node;
    protected $nodePath;
    protected $rootCategory;

    public function __construct(WebDriver $webDriver, AbstractTestCase $testCase, ThemeConfiguration $theme)
    {
        parent::__construct($webDriver, $testCase, $theme);
    }

    /**
     * @param $nodePath
     * @return WebDriverElement
     */

    public function getNode($nodePath)
    {
        $this->nodePath = $nodePath;
        $this->extract();
        return $this->node;
    }

    public function setRootCategory($rootCategory)
    {
        $this->rootCategory = $rootCategory;
    }

    public function extract()
    {
        if (!$this->nodePath) {
            throw new InvalidInstructionException('Node path was not specified');
        }
        $parts = explode('/', $this->nodePath);

        $xpath = $this->theme->getXTreeRootXpath();
        if ($this->rootCategory) {
            $xpath = $this->theme->getXTreeNamedRootXpath($this->rootCategory);
        }
        $xpath .= $this->theme->getXTreeChildNodePrefixXpath();
        
        $previousExpandXpath = '';
        $element = null;
        foreach ($parts as $part) {
            $xpath .= '/' . $this->theme->getXTreeChildXpath($part);
            if(!$this->webDriver->elementExists($xpath, WebDriver::BY_XPATH)) {
                if ($previousExpandXpath) {
                    $this->testCase->assertElementExists($previousExpandXpath, WebDriver::BY_XPATH);
                    $this->webDriver->byXpath($previousExpandXpath)->click();
                    $this->webDriver->wait()->until(ExpectedCondition::elementExists($xpath, WebDriver::BY_XPATH));
                    $this->testCase->sleep('1s'); // Give the menu time to render
                }
            }
            $this->testCase->assertElementExists($xpath, WebDriver::BY_XPATH);
            $element = $this->webDriver->byXpath($xpath);
            if (!$element->isDisplayed()) {
                throw new ElementNotVisibleException('Node element is not visible and cannot be made visible: ' . $part);
            }
            $previousExpandXpath = $xpath . $this->theme->getXTreeChildNodeExpandPrefixXpath();
            $xpath .= $this->theme->getXTreeChildNodePrefixXpath();
        }
        $this->node = $element;
    }

}