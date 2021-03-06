<?php declare(strict_types=1);

namespace Kplngi\Background\Subscriber;


use Kplngi\Background\DependencyInjection\ViewExtension;
use Shopware\Storefront\Event\StorefrontRenderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class StorefrontRender implements EventSubscriberInterface
{
    /**
     * @var ViewExtension
     */
    private $viewExtension;

    public function __construct(ViewExtension $viewExtension)
    {
        $this->viewExtension = $viewExtension;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            StorefrontRenderEvent::class => 'onStorefrontRender'
        ];
    }

    public function onStorefrontRender(StorefrontRenderEvent $storefrontRenderEvent): void
    {
        $this->viewExtension->addPluginConfiguration($storefrontRenderEvent);
    }
}
