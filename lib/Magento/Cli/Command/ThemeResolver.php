<?php

namespace Magium\Magento\Cli\Command;

use Magium\NotFoundException;

class ThemeResolver
{

    public function resolve($class)
    {
        $origClass = $class;

        if (!class_exists($class)) {
            $class = $origClass . '\ThemeConfiguration';
            if (!class_exists($class)) {
                $class = 'Magium\Magento\Themes\\' . $origClass . '\ThemeConfiguration';
                if (!class_exists($class)) {
                    throw new NotFoundException('Could not resolve the theme class for: ' . $origClass);
                }

            }
        }
        return $class;
    }

}