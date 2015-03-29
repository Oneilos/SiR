<?php
/* majora_generator.content_modifier: sir_loading */
/* majora_generator.content_modifier: aliases */

namespace Sir\Bundle\PartnerBundle\DependencyInjection;

use Majora\Framework\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SirPartnerExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services/gen/partner.xml');
        $loader->load('services/partner.xml');

        // aliases

        // Partner aliases
        $this->registerAliases($container, 'sir.partner', $config['partner']);
    }
}
