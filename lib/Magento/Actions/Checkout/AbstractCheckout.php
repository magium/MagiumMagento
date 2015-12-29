<?php

namespace Magium\Magento\Actions\Checkout;

use Magium\Magento\Actions\Checkout\Steps\StepInterface;
abstract class AbstractCheckout
{
    
    protected $steps = [];
    
    public function addStep(StepInterface $step, $before = null)
    {

        if ($before === null) {
            $this->steps[] = $step;
            return;
        }
        $key = array_search($before, $this->steps);
        $stepCount = count($this->steps);
        if ($key !== false) {
            $steps = array_slice($this->steps, 0, $key);
            $steps[] = $step;
            for ($i = $key; $i < $stepCount; $i++) {
                $steps[] = $this->steps[$i];
            }
            $this->steps = $steps;
        } else {
            $this->steps[] = $step;
        }
        
    }
    
    public function getStepInstance($class)
    {
        foreach ($this->steps as $step) {
            if ($step instanceof $class) {
                return $step;
            }
        }
    }
    
    public function execute()
    {
        foreach ($this->steps as $step) {
            if ($step instanceof StepInterface) {
                $continue = $step->execute();
                if (!$continue) return;

                $continue = $step->nextAction();
                if (!$continue) return;
            }
        }
    }
    
}