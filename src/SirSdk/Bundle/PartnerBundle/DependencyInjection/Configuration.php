<?php

namespace SirSdk\Bundle\PartnerBundle\DependencyInjection;

use Sir\Bundle\MajoraBridgeBundle\DependencyInjection\SirMajoraConfiguration;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * PartnerSdkBundle semantical configuration class.
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
     *      $treeBuilder->root('sir_sdk_partner')
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

        return $treeBuilder;
    }
}
