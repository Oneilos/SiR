<?php

namespace Sir\Bundle\AppBundle;

use Dextr\Bundle\AngularBundle\DextrAngularBundle;
use Huntr\Bundle\AngularBundle\HuntrAngularBundle;
use Linkr\Bundle\AngularBundle\LinkrAngularBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SirAppBundle extends Bundle
{
    public static function registerBundles(&$bundles)
    {
        $bundles = array_merge($bundles, self::getSirSdkBundles());
        $bundles = array_merge($bundles, self::getSirBundles());
        $bundles = array_merge($bundles, array(
            new DextrAngularBundle(),
            new LinkrAngularBundle(),
            new HuntrAngularBundle(),
        ));
    }

    private static function getSirBundles()
    {
        return array(
        );
    }

    private static function getSirSdkBundles()
    {
        return array(
        );
    }
}
