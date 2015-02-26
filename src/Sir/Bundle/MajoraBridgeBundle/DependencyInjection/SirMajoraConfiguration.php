<?php

namespace Sir\Bundle\MajoraBridgeBundle\DependencyInjection;

use Majora\Framework\DependencyInjection\MajoraConfiguration;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Configuration class used for sir majora related bundles
 *
 * @package majora-bridge-bundle
 * @subpackage dependency-injection
 */
class SirMajoraConfiguration extends MajoraConfiguration
{
    protected $handledPersistences = array('doctrine', 'fixtures', 'api');
    protected $handledDomains      = array('default', 'api');
    protected $handledLoaders      = array('default', 'api');
}
