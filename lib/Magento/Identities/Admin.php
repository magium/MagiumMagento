<?php

namespace Magium\Magento\Identities;


class Admin extends AbstractEntity
{

    const IDENTITY = 'Admin';

    public $account   = 'admin';
    public $password  = 'Password1';

    public function getAccount()
    {
        return $this->account;
    }

    public function setAccount($account)
    {
        $this->account = $account;
    }
    
}