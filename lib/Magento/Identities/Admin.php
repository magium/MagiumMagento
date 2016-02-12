<?php

namespace Magium\Magento\Identities;


class Admin extends AbstractEntity
{

    const IDENTITY = 'Admin';

    protected $account   = 'admin';
    protected $password  = 'Password1';

    public function getAccount()
    {
        return $this->account;
    }

    public function setAccount($account)
    {
        $this->account = $account;
    }
    
}