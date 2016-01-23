<?php

namespace Magium\Magento\Themes\Magento2\Admin;

class ThemeConfiguration extends \Magium\Magento\Themes\Admin\ThemeConfiguration
{

    protected $loginUsernameField = '//input[@id="username"]';
    protected $loginPasswordField = '//input[@id="login"]';
    protected $loginSubmitButton = '//button[contains(concat(" ",normalize-space(@class)," ")," action-login ")]';

}