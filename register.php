<?php

\Magium\Cli\CommandLoader::addCommandDir('Magium\Magento\Cli\Command', realpath(__DIR__ . '/lib/Magento/Cli/Command'));
\Magium\Cli\Command\ListElements::addDirectory(realpath(__DIR__ . '/lib'), 'Magium');