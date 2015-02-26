<?php

namespace Sir\Bundle\MajoraBridgeBundle\Generator\ContentModifier;

use Majora\Bundle\GeneratorBundle\Generator\ContentModifierInterface;
use Majora\Bundle\GeneratorBundle\Generator\Inflector;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Service alias creation content modifier
 *
 * @package majora-bridge-bundle
 * @subpackage generator
 */
class SdkRoutingModifier
    implements ContentModifierInterface
{
    /**
     * @see ContentModifierInterface::supports()
     */
    public function supports(SplFileInfo $fileinfo, $currentContent, Inflector $inflector)
    {
        return
            // is a sdk bundle
            strpos(
                $inflector->translate($fileinfo->getRealPath()),
                sprintf(
                    'Sdk/Bundle/%sBundle/Resources/config/routing_api.yml',
                    $inflector->translate('MajoraNamespace')
                )
            ) !== false
            &&
            // is routes not already loaded
            strpos(
                $currentContent,
                sprintf('# %s Api', $inflector->translate('MajoraEntity'))
            ) === false
        ;
    }

    /**
     * @see ContentModifierInterface::modify()
     */
    public function modify($fileContent, Inflector $inflector)
    {
        return $fileContent. '
# '. $inflector->translate('MajoraEntity') .' Api
'. $inflector->translate('majora_entity') . '_rest_api:
    resource: "@SirSdk'. $inflector->translate('MajoraNamespace') .'Bundle/Resources/config/routing/gen/'. $inflector->translate('majora_entity') . '_api.yml"
    prefix:   /'. $inflector->translate('majora_entity') . 's
# '. $inflector->translate('MajoraEntity') .' Api
'. $inflector->translate('majora_entity') . '_rest_api:
    resource: "@SirSdk'. $inflector->translate('MajoraNamespace') .'Bundle/Resources/config/routing/'. $inflector->translate('majora_entity') . '_api.yml"
    prefix:   /'. $inflector->translate('majora_entity') . 's
'
        ;
    }
}
