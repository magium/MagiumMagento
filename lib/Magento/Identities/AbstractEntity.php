<?php

namespace Magium\Magento\Identities;

use Magium\AbstractConfigurableElement;

abstract class AbstractEntity extends AbstractConfigurableElement
{
    public $password = 'password';

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }
}