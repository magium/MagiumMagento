<?php

namespace Magium\Magento\Cli\Command;

use Magium\Magento\Cli\Command\Test\ListProductsInCategoryTest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ListProductsInCategory extends Command
{
    protected function configure()
    {
        $this->setName('magento:list-products');
        $this->setDescription('Navigates to a category and extracts the product names.  Used to help determine default product names for your test.');
        $this->addArgument(
            'category',
            InputArgument::REQUIRED,
            'The category to extract the products from (e.g. Accessories/Jewelry)'
        );
        $this->addOption(
            'url',
            null,
            InputOption::VALUE_OPTIONAL,
            'The URL to test against (if omitted it will attempt to retrive it from the theme'
        );
        $this->addOption(
            'theme',
            null,
            InputOption::VALUE_OPTIONAL,
            'The theme to use.  Defaults to Magento19.  Can be short name (Magento18) or fully qualified class name'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $test = new ListProductsInCategoryTest();
        $test->setName('testExecute');
        if ($input->getOption('url')) {
            $test->setBaseUrl($input->getOption('url'));
        }
        if ($input->getOption('theme')) {
            $resolver = new ThemeResolver();
            $test->setTheme($resolver->resolve($input->getOption('theme')));
        }
        $test->setCategoryPath($input->getArgument('category'));
        $test->run();
        $products = $test->getProductNames();
        $output->writeln('Found ' . count($products) . ' products in ' . $input->getArgument('category'));
        foreach ($products as $product) {
            $output->writeln("\t" . trim($product));
        }
    }
    
    
}