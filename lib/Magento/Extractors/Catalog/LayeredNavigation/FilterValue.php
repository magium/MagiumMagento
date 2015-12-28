<?php

namespace Magium\Magento\Extractors\Catalog\LayeredNavigation;

class FilterValue
{
    protected $text;
    protected $link;
    protected $count;

    public function __construct($text, $link, $count)
    {
        $this->text = $text;
        $this->link = $link;
        $this->count = $count;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }


}