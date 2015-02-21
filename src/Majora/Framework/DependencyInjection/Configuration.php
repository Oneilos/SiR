<?php

namespace Majora\Framework\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Configuration class used for majora related bundles
 *
 * @package majora-framework
 * @subpackage dependency-injection
 */
class Configuration
{
    protected $handledPersistences = array('doctrine', 'fixtures', 'api');
    protected $handledDomains      = array('default', 'api');
    protected $handledLoaders      = array('default', 'api');

    /**
     * create and return node section for majora entities
     *
     * @param string $entity
     *
     * @return TreeBuilder
     */
    protected function createEntitySection($entity)
    {
        $treeBuilder = new TreeBuilder();
        $node = $treeBuilder->root($entity);

        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->enumNode('persistence')
                    ->cannotBeEmpty()
                    ->defaultValue('fixtures')
                    ->values($this->handledPersistences)
                ->end()
                ->enumNode('domain')
                    ->cannotBeEmpty()
                    ->defaultValue('default')
                    ->values($this->handledDomains)
                ->end()
                ->enumNode('loader')
                    ->cannotBeEmpty()
                    ->defaultValue('default')
                    ->values($this->handledLoaders)
                ->end()
            ->end()
        ;

        return $node;
    }
}
