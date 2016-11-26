<?php

namespace Magium\Magento\Actions\Admin\Tables;

use Magium\Actions\OptionallyConfigurableActionInterface;
use Magium\Magento\Actions\Admin\Widget\ClickActionButton;
use Magium\Magento\Navigators\Admin\AdminMenu;
use Magium\Magento\Themes\Admin\ThemeConfiguration;
use Magium\Util\Translator\Translator;
use Magium\WebDriver\WebDriver;

class RemoveTermsAndConditions implements OptionallyConfigurableActionInterface
{

    const ACTION = 'Admin\Tables\RemoveTermsAndConditions';

    protected $webDriver;
    protected $themeConfiguration;
    protected $navigator;
    protected $clickActionButton;
    protected $translator;

    public function __construct(
            WebDriver $webDriver,
            ThemeConfiguration $themeConfiguration,
            AdminMenu $navigator,
            ClickActionButton $clickActionButton,
            Translator $translator
        )
    {
        $this->webDriver = $webDriver;
        $this->themeConfiguration = $themeConfiguration;
        $this->navigator = $navigator;
        $this->clickActionButton = $clickActionButton;
        $this->translator = $translator;
    }

    public function removeAll($navigate = false)
    {
        if ($navigate) {
            $this->navigator->navigateTo('Sales/Terms and conditions');
        }

        $xpath = $this->themeConfiguration->getFirstTermsRowXpath();

        while ($this->webDriver->elementExists($xpath, WebDriver::BY_XPATH)) {
            $this->webDriver->byXpath($xpath)->click();
            $this->clickActionButton->click($this->translator->translate('Delete Condition'));
            $this->webDriver->switchTo()->alert()->accept();
        }

    }

    public function execute($param = null)
    {
        $this->removeAll($param);
    }

}