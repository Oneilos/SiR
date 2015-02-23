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
class ServiceLoadingModifier
    implements ContentModifierInterface
{
    /**
     * @see ContentModifierInterface::supports()
     */
    public function supports(SplFileInfo $fileinfo, $currentContent, Inflector $inflector)
    {
        return
            // is a bundle extension
            strpos(
                $inflector->translate($fileinfo->getFilename()),
                sprintf('%sExtension.php', $inflector->translate('MajoraNamespace'))
            ) !== false
            &&
            // is entity not already loaded
            strpos(
                $currentContent,
                sprintf('$loader->load(\'services/%s.xml\')', $inflector->translate('majora_entity'))
            ) === false
        ;
    }

    /**
     * @see ContentModifierInterface::modify()
     */
    public function modify($fileContent, Inflector $inflector)
    {
        return str_replace(
            '$loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.\'/../Resources/config\'));',
                sprintf(
            '$loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.\'/../Resources/config\'));
        $loader->load(\'services/gen/%s.xml\');
        $loader->load(\'services/%s.xml\');',
                    $inflector->translate('majora_entity'),
                    $inflector->translate('majora_entity')
                ),
            $fileContent
        );
    }
}
