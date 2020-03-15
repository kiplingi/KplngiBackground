<?php declare(strict_types=1);

namespace Kplngi\Background\Test\Configuration;

use PHPUnit\Framework\TestCase;
use Kplngi\Background\Subscriber\StorefrontRender;
use Shopware\Storefront\Event\StorefrontRenderEvent;

class StorefrontRenderTest extends TestCase
{
    public function testGetSubscribedEvents(): void
    {
        $subscribedEvents = StorefrontRender::getSubscribedEvents();
        $expectedEvents = [
            StorefrontRenderEvent::class => 'onStorefrontRender'
        ];

        static::assertSame($expectedEvents, $subscribedEvents);
    }
}
