<?php declare(strict_types=1);

namespace Kplngi\Background\DependencyInjection;

use Kplngi\Background\Configuration\PluginConfiguration;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Event\StorefrontRenderEvent;

class ViewExtension
{
    /**
     * @var SystemConfigService
     */
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

        if (!array_key_exists('KplngiBackground.config.backgroundType', $pluginConfiguration)) {
            return;
        }

        if ($pluginConfiguration['KplngiBackground.config.backgroundType'] == 'image') {
            if (!array_key_exists('KplngiBackground.config.imageUrl', $pluginConfiguration)) {
                return;
            }
            $pluginConfigurationStruct->setInlineStyle('background-image: url(' . $pluginConfiguration['KplngiBackground.config.imageUrl'] . ')');
        } elseif ($pluginConfiguration['KplngiBackground.config.backgroundType'] == 'color') {
            if (
                !array_key_exists('KplngiBackground.config.color', $pluginConfiguration)
            ) {
                return;
            }
            $pluginConfigurationStruct->setInlineStyle('background-color:' . $pluginConfiguration['KplngiBackground.config.color']);
        }

        /** @var SalesChannelContext */
        $navigationPage = $storefrontRenderEvent->getSalesChannelContext();
        $navigationPage->addExtension('kplngi_background', $pluginConfigurationStruct);
    }
}
