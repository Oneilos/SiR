<?php
/* majora_generator.content_modifier: sir_loading */
/* majora_generator.content_modifier: aliases */

namespace Sir\Bundle\MajoraNamespaceBundle\DependencyInjection;

use Majora\Framework\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SirMajoraNamespaceExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services/gen/majora_entity.xml');
        $loader->load('services/majora_entity.xml');

        // aliases

        // MajoraEntity aliases
        $this->registerAliases($container, 'sir.majora_entity', $config['majora_entity']);
    }
}
