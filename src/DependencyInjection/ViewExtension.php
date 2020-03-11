<?php declare(strict_types=1);

namespace Kplngi\Background\DependencyInjection;

use Kplngi\Background\Configuration\PluginConfiguration;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Event\StorefrontRenderEvent;
use Shopware\Storefront\Page\Navigation\NavigationPage;

class ViewExtension
{
    private $systemConfigService;

    public function __construct(SystemConfigService $systemConfigService)
    {
        $this->systemConfigService = $systemConfigService;
    }

    public function addPluginConfiguration(StorefrontRenderEvent $storefrontRenderEvent): void
    {
        $pluginConfiguration = $this->systemConfigService->getDomain(
            'KplngiBackground.config',
            $storefrontRenderEvent->getSalesChannelContext()->getSalesChannel()->getId(),
            true
        );

        if ($pluginConfiguration["KplngiBackground.config.active"] == false) {
            return;
        }

        $pluginConfigurationStruct = new PluginConfiguration();

        if (!$pluginConfiguration['KplngiBackground.config.backgroundType']) {
            return;
        }

        if ($pluginConfiguration['KplngiBackground.config.backgroundType'] == 'image') {
            if (!$pluginConfiguration['KplngiBackground.config.imageUrl']) {
                return;
            }
            $pluginConfigurationStruct->setInlineStyle('background-image: url(' . $pluginConfiguration['KplngiBackground.config.imageUrl'] . ')');
        } elseif ($pluginConfiguration['KplngiBackground.config.backgroundType'] == 'color') {
            if (!$pluginConfiguration['KplngiBackground.config.color']) {
                return;
            }
            $pluginConfigurationStruct->setInlineStyle('background-color:' . $pluginConfiguration['KplngiBackground.config.color']);
        }

        /** @var SalesChannelContext */
        $navigationPage = $storefrontRenderEvent->getSalesChannelContext();
        $navigationPage->addExtension('kplngi_background', $pluginConfigurationStruct);
    }
}
