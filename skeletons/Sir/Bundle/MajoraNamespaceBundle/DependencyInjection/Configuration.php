<?php

namespace Sir\Bundle\MajoraNamespaceBundle\DependencyInjection;

use Majora\Framework\DependencyInjection\Configuration as MajoraConfiguration;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration extends MajoraConfiguration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sir_majora_namespace');

        $rootNode
            ->children()

                // MajoraEntity section
                ->append($this->createEntitySection('majora_entity'))

            ->end()
        ;

        return $treeBuilder;
    }
}
