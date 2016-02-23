<?php

namespace Magium\Magento\Navigators\Admin\Customer;

abstract class AbstractCustomerNavigation
{

    protected $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function getSearch()
    {
        return $this->search;
    }

    public abstract function getSelectorID();

}