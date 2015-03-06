<?php

namespace Majora\Bundle\GeneratorBundle\Generator;

use Doctrine\Common\Collections\ArrayCollection;
use Psr\Log\LoggerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class which generate / update / delete code classes
 * according to a whole file structure.
 */
class FileGenerator
{
    protected $projectBasePath;
    protected $skeletonsPath;
    protected $targetPath;
    protected $filesystem;
    protected $logger;
    protected $contentModifiers;

    /**
     * construct.
     *
     * @param string          $projectBasePath
     * @param string          $skeletonsDir
     * @param string          $targetDir
     * @param Filesystem      $filesystem
     * @param LoggerInterface $logger
     */
    public function __construct(
        $projectBasePath,
        $skeletonsDir,
        $targetDir,
        Filesystem      $filesystem,
        LoggerInterface $logger
    ) {
        $this->projectBasePath  = $projectBasePath;
        $this->skeletonsPath    = realpath(sprintf('%s/%s', $projectBasePath, $skeletonsDir));
        $this->targetPath       = realpath(sprintf('%s/%s', $projectBasePath, $targetDir));
        $this->filesystem       = $filesystem;
        $this->logger           = $logger;
        $this->contentModifiers = new ArrayCollection();
    }

    /**
     * register a content modifier for file generation.
     *
     * @param string                   $alias
     * @param ContentModifierInterface $contentModifier
     */
    public function registerContentModifier($alias, ContentModifierInterface $contentModifier)
    {
        $this->contentModifiers->set($alias, $contentModifier);
    }

    /**
     * generate targer file path from source path.
     *
     * @param SplFileInfo $fileinfo
     * @param Inflector   $inflector
     *
     * @return string
     */
    protected function generatePath(SplFileInfo $fileinfo, Inflector $inflector)
    {
        return $inflector->translate(sprintf('%s%s',
            $this->targetPath,
            str_replace($this->skeletonsPath, '', $fileinfo->getRealPath())
        ));
    }

    /**
     * parse metadata from given template content.
     *
     * @param string $templateFileContent
     *
     * @return array<alias, array>
     */
    protected function getMetadata($templateFileContent)
    {
        $regex           = '/majora_generator\.([a-z0-9_]+)\:\s*([\w]+)/';
        $handledMetaData = array('force_generation', 'content_modifier');

        $templateFileMetadata = array();
        if (!preg_match_all($regex, $templateFileContent, $matches, PREG_SET_ORDER)) {
            return $templateFileMetadata;
        }

        foreach ($matches as $match) {
            if (!in_array($match[1], $handledMetaData)) {
                continue;
            }
            if (empty($templateFileMetadata[$match[1]])) {
                $templateFileMetadata[$match[1]] = array();
            }

            $templateFileMetadata[$match[1]][] = is_bool($match[2]) ?
                ((bool) $match[2]) === true : $match[2]
            ;
        }

        return $templateFileMetadata;
    }

    public function generate($entity, $namespace)
    {
        $finder    = new Finder();
        $inflector = new Inflector(array(
            'MajoraEntity'    => $entity,
            'MajoraNamespace' => $namespace,
        ));

        // create file tree
        foreach ($finder->in($this->skeletonsPath) as $templateFile) {
            $fileContent = $templateFile->getContents();
            $metadata    = $this->getMetadata($fileContent);

            $generatedFilePath = $this->generatePath($templateFile, $inflector);
            if ($this->filesystem->exists($generatedFilePath)
                && empty($metadata['force_generation'])
            ) {
                // contents needs to be updated ?
                if (empty($metadata['content_modifier'])) {
                    continue;
                }

                $fileContent = file_get_contents($generatedFilePath);
            }

            // directory
            if ($templateFile->isDir()) {
                $this->filesystem->mkdir($generatedFilePath);
                $this->logger->info(sprintf('dir created : %s', $generatedFilePath));
            }

            // file
            if ($templateFile->isFile()) {
                $fileContent = $inflector->translate($fileContent);
                if (!empty($metadata['content_modifier'])) {
                    foreach ($metadata['content_modifier'] as $modifierAlias) {
                        if (!($modifier = $this->contentModifiers->get($modifierAlias))
                            || !$modifier->supports($templateFile, $fileContent, $inflector)
                        ) {
                            continue;
                        }

                        $fileContent = $modifier->modify($fileContent, $inflector);
                    }
                }

                $updated = is_file($generatedFilePath);
                $forced  = !empty($metadata['force_generation']);

                $this->filesystem->dumpFile($generatedFilePath, $fileContent);
                $this->logger->info(sprintf('file %s : %s',
                    $forced ? 'forced' : ($updated ? 'updated' : 'created'),
                    $generatedFilePath
                ));
            }
        }
    }
}
