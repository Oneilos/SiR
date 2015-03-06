<?php

namespace Sir\Bundle\MajoraBridgeBundle\Generator\ContentModifier;

use Majora\Bundle\GeneratorBundle\Generator\ContentModifier\RegisterBundleModifier;
use Majora\Bundle\GeneratorBundle\Generator\Inflector;

/**
 * Service for updating sir app bundle from a bundle class.
 */
class AppBundleModifier
    extends RegisterBundleModifier
{
    /**
     * @see ContentModifierInterface::modify()
     */
    public function modify($fileContent, Inflector $inflector)
    {
        file_put_contents(
            $this->kernelPath,
            str_replace(
                sprintf('private static function get%sBundles()
    {
        return array(',
                $this->currentNamespace),
                sprintf('private static function get%sBundles()
    {
        return array(
            new \%s\%s(),',
                    $this->currentNamespace,
                    $this->currentBundleNamespace,
                    $this->currentBundleClass
                ),
                file_get_contents($this->kernelPath)
            )
        );

        $this->logger->info(sprintf('file updated : %s', $this->kernelPath));

        return $fileContent;
    }
}
