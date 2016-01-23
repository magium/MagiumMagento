<?php

namespace Magium\Magento\Extractors\Catalog\Product;

class Option
{

    protected $name;

    protected $options = [];

    public function __construct(
        $name
    )
    {
        $this->name = $name;
    }

    public function addOption(Value $option)
    {
        $this->options[] = $option;
    }

    /**
     *
     * @return Value[]
     */

    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $label
     * @return Value|null
     */

    public function getOption($label)
    {
        $label = strtolower($label);
        foreach ($this->getOptions() as $option) {
            $text = strtolower($option->getText());
            if ($label == $text) {
                return $option;
            }
        }
        return null;
    }

    public function getName()
    {
        return $this->name;
    }

}