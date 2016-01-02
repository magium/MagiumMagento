<?php

namespace Magium\Magento\Identities;


class Admin extends AbstractEntity
{

    const IDENTITY = 'Admin';

    protected $account   = 'admin';
    protected $password  = 'password';

    public function getAccount()
    {
        return $this->account;
    }
    
}