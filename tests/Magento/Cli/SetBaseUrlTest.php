<?php

namespace Tests\Magium\Magento\Cli;

use Symfony\Component\Console\Tester\CommandTester;
use Tests\Magium\Cli\AbstractCliTest;

class SetBaseUrlTest extends AbstractCliTest
{

    public function testSetBaseUrlWithNoThemeDefaultsTo19()
    {
        $application = $this->getConfiguredApplication();
        $command = $application->find('magium:init');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $command = $application->find('magento:base-url');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'url'   => 'http://example.com'
        ]);

        $json = json_decode(file_get_contents($this->getCliConfigFilename()), true);

        self::assertArrayHasKey('magium', $json);
        self::assertArrayHasKey('magium\magento\themes\magento19\themeconfiguration', $json['magium']);
    }

    public function testSetBaseUrlWithShortThemeGetsExpanded()
    {
        $application = $this->getConfiguredApplication();
        $command = $application->find('magium:init');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $command = $application->find('magento:base-url');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'url'   => 'http://example.com',
            'theme'   => 'Magento18'
        ]);

        $json = json_decode(file_get_contents($this->getCliConfigFilename()), true);

        self::assertArrayHasKey('magium', $json);
        self::assertArrayHasKey('magium\magento\themes\magento18\themeconfiguration', $json['magium']);
    }

    public function testSetBaseUrlWithFQThemeIsLeftAlone()
    {
        $application = $this->getConfiguredApplication();
        $command = $application->find('magium:init');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $command = $application->find('magento:base-url');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'url'   => 'http://example.com',
            'theme'   => 'Tests\Magium\Magento\Cli\Test\Theme'
        ]);

        $json = json_decode(file_get_contents($this->getCliConfigFilename()), true);

        self::assertArrayHasKey('magium', $json);
        self::assertArrayHasKey('tests\magium\magento\cli\test\theme', $json['magium']);
    }

}