<?php declare(strict_types=1);

namespace Kplngi\Background\Configuration;

use Shopware\Core\Framework\Struct\Struct;

class PluginConfiguration extends Struct
{
    /** @var string */
    private $inlineStyle;

    /**
     * @return string
     */
    public function getInlineStyle(): ?string
    {
        return $this->inlineStyle;
    }

    /**
     * @param string $inlineStyle
     */
    public function setInlineStyle(string $inlineStyle): void
    {
        $this->inlineStyle = $inlineStyle;
    }
}
