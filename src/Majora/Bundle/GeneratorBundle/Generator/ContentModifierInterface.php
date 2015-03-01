<?php

namespace Majora\Bundle\GeneratorBundle\Generator;

use Symfony\Component\Finder\SplFileInfo;

/**
 * Interface for generator content modifiers.
 */
interface ContentModifierInterface
{
    /**
     * return if modifier supports given file.
     *
     * @param SplFileInfo $fileinfo
     * @param string      $currentContent targetFile pending generation content
     * @param Inflector   $inflector
     *
     * @return boolean
     */
    public function supports(SplFileInfo $fileinfo, $currentContent, Inflector $inflector);

    /**
     * modify given content with given inflector.
     *
     * @param string    $fileContent
     * @param Inflector $inflector
     *
     * @return string the modified content
     */
    public function modify($fileContent, Inflector $inflector);
}
