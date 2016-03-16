<?php

namespace Magium\Magento\Cli\Command\Test;

use Magium\Extractors\Navigation\Menu;
use Magium\Magento\AbstractMagentoTestCase;

class ExtractNavigationXpathTest extends AbstractMagentoTestCase
{

    protected $baseXpath;
    protected $childXpath;

    protected $url;
    protected $category;

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getBaseXpath()
    {
        return $this->baseXpath;
    }

    /**
     * @return mixed
     */
    public function getChildXpath()
    {
        return $this->childXpath;
    }



    public function testExecute()
    {
        if (!$this->category || !$this->url) {
            throw new MissingConfigurationException('Both the category and the url must be provided');
        }
        $this->commandOpen($this->url);

        $extractor = $this->getExtractor(Menu::EXTRACTOR);
        /* @var $extractor Menu */
        $extractor->setPath($this->category);
        $extractor->extract();
        $this->baseXpath = $extractor->getBaseXpath();
        $this->childXpath = $extractor->getChildXpath();
    }

}