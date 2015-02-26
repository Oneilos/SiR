<?php
/* majora_generator.content_modifier: configuration_node */

namespace Sir\Bundle\MajoraNamespaceBundle\DependencyInjection;

use Sir\Bundle\MajoraBridgeBundle\DependencyInjection\SirMajoraConfiguration;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * MajoraNamespaceSdkBundle semantical configuration class.
 */
class Configuration extends SirMajoraConfiguration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     *
     * @see http://symfony.com/doc/current/components/config/definition.html
     *
     * @example to create configuration tree, use theses lines :
     *      $treeBuilder = new TreeBuilder();
     *      $treeBuilder->root('sir_majora_namespace')
     *          ->children()
     *              ->scalarNode('...')
     *                  ->isRequired()
     *              ->end()
     *              ->arrayNode()
     *                  ->addDefaultsIfNotSet()
     *                  ->children()
     *                       // more nodes here
     *                  ->end()
     *              ->end()
     *          ->end()
     *      ;
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
