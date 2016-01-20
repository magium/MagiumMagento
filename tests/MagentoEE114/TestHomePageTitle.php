<?php

namespace Tests\Magium\MagentoEE114;


class TestHomePageTitle extends \Tests\Magium\Magento\TestHomePageTitle
{

    public function testTitleExists()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->assertElementExists('//title', self::BY_XPATH);
    }

    public function testBadTitleNotExists()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->assertElementNotExists('//title[.="boogers"]', self::BY_XPATH);
    }

}