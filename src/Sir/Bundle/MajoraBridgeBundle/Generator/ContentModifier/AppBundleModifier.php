<?php

namespace Sir\Bundle\MajoraBridgeBundle\Generator\ContentModifier;

use Majora\Bundle\GeneratorBundle\Generator\ContentModifierInterface;
use Majora\Bundle\GeneratorBundle\Generator\Inflector;
use Psr\Log\LoggerInterface;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Service for updating sir app bundle from a bundle class.
 */
class AppBundleModifier
    implements ContentModifierInterface
{
    protected $appBundlePath;
    protected $logger;

    protected $currentBundleNamespace;
    protected $currentBundleClass;
    protected $currentNamespace;

    /**
     * construct.
     *
     * @param string          $appBundlePath
     * @param LoggerInterface $logger
     */
    public function __construct($appBundlePath, LoggerInterface $logger)
    {
        $this->appBundlePath = $appBundlePath;
        $this->logger        = $logger;
    }

    /**
     * @see ContentModifierInterface::supports()
     */
    public function supports(SplFileInfo $fileinfo, $currentContent, Inflector $inflector)
    {
        $this->currentBundleNamespace = null;
        $this->currentBundleClass     = null;
        $this->currentNamespace       = null;

        if (!preg_match(
            sprintf('/namespace (.*%s.*Bundle);/', $inflector->translate('MajoraNamespace')),
            $currentContent,
            $matches
        )) {
            return false;
        }

        $this->currentBundleNamespace = $matches[1];

        if (!preg_match(
            sprintf('/class (([\w]*)%s[\w]*Bundle) extends /', $inflector->translate('MajoraNamespace')),
            $currentContent,
            $matches
        )) {
            return false;
        }

        $this->currentBundleClass = $matches[1];
        $this->currentNamespace   = $matches[2];

        return
            // is bundle not already registered
            strpos(
                file_get_contents($this->appBundlePath),
                sprintf('new \%s\%s()', $this->currentBundleNamespace, $this->currentBundleClass)
            ) === false
        ;
    }

    /**
     * @see ContentModifierInterface::modify()
     */
    public function modify($fileContent, Inflector $inflector)
    {
        file_put_contents(
            $this->appBundlePath,
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
                file_get_contents($this->appBundlePath)
            )
        );

        $this->logger->info(sprintf('file updated : %s',
            $this->appBundlePath
        ));

        return $fileContent;
    }
}
