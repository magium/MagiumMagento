<?php

namespace Magium\Magento\Actions\Admin\Widget;

use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverSelect;
use Magium\Magento\Extractors\Admin\Widget\Attribute;
use Magium\Magento\Navigators\Admin\AdminMenu;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\Util\Translator\Translator;
use Magium\WebDriver\WebDriver;

class TermsAndConditions
{

    const ACTION = 'Admin\Widget\TermsAndConditions';

    const STATUS_ENABLED = 'Enabled';
    const STATUS_DISABLED = 'Disabled';

    protected $webDriver;
    protected $themeConfiguration;
    protected $navigator;
    protected $clickActionButton;
    protected $translator;
    protected $attribute;

    protected $name;
    protected $status;
    protected $contentAs;
    protected $storeView;
    protected $checkboxText;
    protected $content;
    protected $contentHeight;

    protected $save = true;

    public function __construct(
        WebDriver $webDriver,
        ThemeConfiguration $themeConfiguration,
        AdminMenu $navigator,
        ClickActionButton $clickActionButton,
        Translator $translator,
        Attribute $attribute
    )
    {
        $this->webDriver = $webDriver;
        $this->themeConfiguration = $themeConfiguration;
        $this->navigator = $navigator;
        $this->clickActionButton = $clickActionButton;
        $this->translator = $translator;
        $this->attribute = $attribute;

    }

    /**
     * @param mixed $checkboxText
     */
    public function setCheckboxText($checkboxText)
    {
        $this->checkboxText = $checkboxText;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param mixed $contentAs
     */
    public function setContentAs($contentAs)
    {
        $this->contentAs = $contentAs;
    }

    /**
     * @param mixed $contentHeight
     */
    public function setContentHeight($contentHeight)
    {
        $this->contentHeight = $contentHeight;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param string $storeView
     */
    public function setStoreView($storeView)
    {
        $this->storeView = $storeView;
    }

    public function execute($save = true)
    {
        $this->save = $save;
        try {
            $this->clickActionButton->click($this->translator->translate('Add New Condition'));
        } catch (NoSuchElementException $e) {
            // Don't worry about it.  Perhaps we're not on the main terms page.
        }

        $element = $this->attribute->getElementByLabel($this->translator->translate('Condition Name'));
        $element->clear();
        if ($this->name) {
            $element->sendKeys($this->name);
        }

        if ($this->contentAs) {
            $select = new WebDriverSelect($this->attribute->getElementByLabel($this->translator->translate('Show Content as')));
            $select->selectByVisibleText($this->contentAs);
        }

        if ($this->status) {
            $select = new WebDriverSelect($this->attribute->getElementByLabel($this->translator->translate('Status')));
            $select->selectByVisibleText($this->status);
        }

        if ($this->storeView) {
            $storeViewElement = $this->attribute->getElementByLabel($this->translator->translate('Store View'));
            $xpath = sprintf('//option[.="%s"]', $this->storeView);
            $element = $storeViewElement->findElement(WebDriverBy::xpath($xpath));
            $element->click();
        }


        $element = $this->attribute->getElementByLabel($this->translator->translate('Checkbox Text'));
        $element->clear();
        if ($this->checkboxText) {
            $element->sendKeys($this->checkboxText);
        }
        $element = $this->attribute->getElementByLabel($this->translator->translate('Content'));
        $element->clear();
        if ($this->content) {
            $element->sendKeys($this->content);
        }

        $element = $this->attribute->getElementByLabel($this->translator->translate('Content Height (css)'));
        $element->clear();
        if ($this->contentHeight) {
            $element->sendKeys($this->contentHeight);
        }

        $this->preSave();
        if ($this->save) {
            $this->webDriver->executeScript('window.scrollTo(0, 0);');
            $this->clickActionButton->click($this->translator->translate('Save Condition'));
        }
    }

    protected function preSave()
    {

    }
}