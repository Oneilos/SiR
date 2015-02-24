<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            // Propel
            new Propel\PropelBundle\PropelBundle(),
            new Glorpen\Propel\PropelBundle\GlorpenPropelBundle(),

            // Tools bundles
            new Mopa\Bundle\BootstrapBundle\MopaBootstrapBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Ornicar\GravatarBundle\OrnicarGravatarBundle(),

            // Workflow
            new EasyTask\Bundle\WorkflowBundle\EasyTaskWorkflowBundle(),

            // Core
            new LinkR\Bundle\TaskBundle\LinkRTaskBundle(),
            new LinkR\Bundle\UserBundle\LinkRUserBundle(),

            // Other features
            new LinkR\Bundle\CommentBundle\LinkRCommentBundle(),
            new LinkR\Bundle\SearchBundle\LinkRSearchBundle(),
            new LinkR\Bundle\ActivityBundle\LinkRActivityBundle(),
            new LinkR\Bundle\MenuBundle\LinkRMenuBundle(),
            new LinkR\Bundle\NotificationBundle\LinkRNotificationBundle(),
            new LinkR\Bundle\GroupBundle\LinkRGroupBundle(),
            new LinkR\Bundle\DocumentBundle\LinkRDocumentBundle(),
            new LinkR\Bundle\MissionBundle\LinkRMissionBundle(),
            new LinkR\Bundle\AgencyBundle\LinkRAgencyBundle(),
            new LinkR\Bundle\CEOBundle\LinkRCEOBundle(),

            // Workflows
            new LinkR\Workflow\CrhMonitoringBundle\LinkRWorkflowCrhMonitoringBundle(),
            new LinkR\Workflow\MissionMonitoringBundle\LinkRWorkflowMissionMonitoringBundle(),
            new LinkR\Workflow\AnnualReviewBundle\LinkRWorkflowAnnualReviewBundle(),
            new LinkR\Workflow\LunchBundle\LinkRWorkflowLunchBundle()
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
