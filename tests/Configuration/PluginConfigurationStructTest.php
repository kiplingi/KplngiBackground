<?php declare(strict_types=1);

namespace Kplngi\Background\Test\Configuration;

use PHPUnit\Framework\TestCase;
use Kplngi\Background\Configuration\PluginConfiguration;

class PluginConfigurationStructTest extends TestCase
{
    public function testAssign(): void
    {
        $data = [
            'id' => 'anId',
            'inlineStyle' => 'aString'
        ];

        $testConfiguration = new PluginConfiguration();

        $testConfiguration->assign($data);

        $testJsonString = json_encode($testConfiguration);
        static::assertIsString($testJsonString);
    }

    public function testSet(): void
    {
        $testConfiguration = new PluginConfiguration();

        $testConfiguration->setInlineStyle('inlineStyle');

        static::assertEquals('inlineStyle', $testConfiguration->getInlineStyle());
    }
}
