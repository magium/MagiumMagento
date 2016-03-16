<?php

namespace Magium\Magento\Cli\Command;

use Magium\Magento\Cli\Command\Test\ExtractNavigationXpathTest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExtractNavigationXpath extends Command
{

    protected function configure()
    {
        $this->setName('magento:extract-navigation-xpath');
        $this->setDescription('Will run a series of tests on the provided URL to attempt to extract the navigation Xpath for the theme configuration');
        $this->addArgument(
            'url',
            InputArgument::REQUIRED,
            'The URL to test against'
        );
        $this->addArgument(
            'category',
            InputArgument::REQUIRED,
            'The category path to use as a base (e.g. Accessories/Jewelry)'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $test = new ExtractNavigationXpathTest();
        $test->setName('testExecute');
        $test->setUrl($input->getArgument('url'));
        $test->setCategory($input->getArgument('category'));
        $test->run();

        $output->writeln('Paste the following lines into your theme configuration file');
        $output->writeln(sprintf("\$this->navigationBaseXPathSelector = '%s';", $test->getBaseXpath()));
        $output->writeln(sprintf("\$this->navigationChildXPathSelector = '%s';", $test->getChildXpath()));
    }

}