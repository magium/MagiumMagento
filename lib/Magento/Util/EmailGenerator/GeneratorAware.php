<?php

namespace Magium\Magento\Util\EmailGenerator;

interface GeneratorAware
{

    public function setGenerator(Generator $generator);

}