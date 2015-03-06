<?php

namespace Sir\Bundle\AppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder->root('sir_app')
            ->children()
                ->arrayNode('hosts')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->children()
                        ->scalarNode('api')
                            ->isRequired()->cannotBeEmpty()
                        ->end()
                        ->scalarNode('huntr')
                            ->isRequired()->cannotBeEmpty()
                        ->end()
                        ->scalarNode('dextr')
                            ->isRequired()->cannotBeEmpty()
                        ->end()
                        ->scalarNode('linkr')
                            ->isRequired()->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
