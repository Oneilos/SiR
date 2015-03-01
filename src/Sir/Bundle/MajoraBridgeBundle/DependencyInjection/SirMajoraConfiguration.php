<?php

namespace Sir\Bundle\MajoraBridgeBundle\DependencyInjection;

use Majora\Framework\DependencyInjection\MajoraConfiguration;

/**
 * Configuration class used for sir majora related bundles.
 */
class SirMajoraConfiguration extends MajoraConfiguration
{
    protected $handledPersistences = array('doctrine', 'fixtures', 'api');
    protected $handledDomains      = array('default', 'api');
    protected $handledLoaders      = array('default', 'api');
}
