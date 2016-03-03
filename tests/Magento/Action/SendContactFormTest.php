<?php

namespace Tests\Magium\Magento\Action;

use Magium\Magento\AbstractMagentoTestCase;
use Magium\Magento\Actions\Misc\SubmitContactForm;

class SendContactFormTest extends AbstractMagentoTestCase
{

    public function testContactFormWorks()
    {
        $this->commandOpen($this->getTheme()->getBaseUrl());
        $this->byText('{{Contact Us}}')->click();
        $contactForm = $this->getAction(SubmitContactForm::ACTION);
        /* @var $contactForm SubmitContactForm */
        $contactForm->setComment('This is a comment');
        $contactForm->execute();
    }

}