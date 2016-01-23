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

    public function addValue(Value $option)
    {
        $this->options[] = $option;
    }

    /**
     *
     * @return Value[]
     */

    public function getValues()
    {
        return $this->options;
    }

    /**
     * @param $label
     * @return Value|null
     */

    public function getValue($label)
    {
        $label = strtolower($label);
        foreach ($this->getValues() as $option) {
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