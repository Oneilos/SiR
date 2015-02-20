<?php

namespace Majora\Bundle\GeneratorBundle\Generator;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class which generate / update / delete code classes
 * according to a whole file structure
 *
 * @package majora-generator-bundle
 * @subpackage generator
 */
class FileGenerator
{
    protected $projectBasePath;
    protected $skeletonsPath;
    protected $targetPath;
    protected $filesystem;
    protected $logger;

    /**
     * construct
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
    )
    {
        $this->projectBasePath = $projectBasePath;
        $this->skeletonsPath   = realpath(sprintf('%s/%s', $projectBasePath, $skeletonsDir));
        $this->targetPath      = realpath(sprintf('%s/%s', $projectBasePath, $targetDir));;
        $this->filesystem      = $filesystem;
        $this->logger          = $logger;
    }

    protected function prepareReplacements($entity, $namespace)
    {
        return array(
            'MajoraEntity'     => Container::camelize($entity),
            'majoraEntity'     => lcfirst(Container::camelize($entity)),
            'majora_entity'    => Container::underscore($entity),
            'majora-entity'    => str_replace('_', '-', Container::underscore($entity)),
            'MajoraNamespace'  => Container::camelize($namespace),
            'majoraNamespace'  => lcfirst(Container::camelize($namespace)),
            'majora_namespace' => Container::underscore($namespace),
            'majora-namespace' => str_replace('_', '-', Container::underscore($namespace)),
        );
    }

    protected function translate($content, array $replacements)
    {
        return strtr($content, $replacements);
    }

    protected function generatePath(SplFileInfo $fileinfo, array $replacements)
    {
        return $this->translate(
            sprintf('%s%s',
                $this->targetPath,
                str_replace($this->skeletonsPath, '', $fileinfo->getRealPath())
            ),
            $replacements
        );
    }

    public function generate($entity, $namespace)
    {
        $finder       = new Finder();
        $replacements = $this->prepareReplacements($entity, $namespace);

        // create file tree
        foreach($finder->in($this->skeletonsPath) as $templateFile) {

            $generatedFilePath = $this->generatePath($templateFile, $replacements);
            if ($this->filesystem->exists($generatedFilePath)) {
                continue;
            }

            // directory
            if ($templateFile->isDir()) {
                $this->filesystem->mkdir($generatedFilePath);
                $this->logger->info(sprintf('dir+ : %s', $generatedFilePath));
            }

            // file
            if ($templateFile->isFile()) {
                $this->filesystem->dumpFile(
                    $generatedFilePath,
                    $this->translate($templateFile->getContents(), $replacements)
                );
                $this->logger->info(sprintf('file+ : %s', $generatedFilePath));
            }
        }

        // updating files
        $updates = array(
            array(
                'finder'   => (new Finder)
                    ->in($this->targetPath)
                    ->name(sprintf('*%sExtension.php', $replacements['MajoraNamespace']))
                ,
                'callback' => function (SplFileInfo $file) use ($entity, $namespace, $replacements) {
                    return str_replace(
                        '$loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.\'/../Resources/config\'));',
                        sprintf(
        '$loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.\'/../Resources/config\'));
        $loader->load(\'services/%s.xml\');',
        $replacements['majora_entity']),
                        $file->getContents()
                    );
                }
            )
        );

        foreach ($updates as $updateData) {
            extract($updateData);
            foreach ($finder as $fileinfo) {
                $this->filesystem->dumpFile(
                    $fileinfo->getRealPath(),
                    call_user_func($callback, $fileinfo)
                );
            }
        }

    }
}
