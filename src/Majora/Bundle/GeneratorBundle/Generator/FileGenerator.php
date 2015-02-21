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
            'MAJORA_ENTITY'    => strtoupper($entity),
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

            // separated service file
            array(
                'finder' => (new Finder)
                    ->in($this->targetPath)
                    ->name(sprintf('*%sExtension.php', $replacements['MajoraNamespace']))
                    ->notContains(sprintf('$loader->load(\'services/%s.xml\')', $replacements['majora_entity']))
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
            ),

            // configuration
            array(
                'finder' => (new Finder)
                    ->in($this->targetPath.'/Sir')
                    ->name('Configuration.php')
                    ->notContains(sprintf('// %s section', $replacements['MajoraEntity']))
                ,
                'callback' => function (SplFileInfo $file) use ($entity, $namespace, $replacements) {
                    return str_replace(
        '$rootNode
            ->children()',
        '$rootNode
            ->children()

                // '. $replacements['MajoraEntity'] .' section
                ->append($this->createEntitySection(\''. $replacements['majora_entity'] .'\'))'
                        ,
                        $file->getContents()
                    );
                }
            ),

            // aliases
            array(
                'finder' => (new Finder)
                    ->in($this->targetPath)
                    ->name(sprintf('*%sExtension.php', $replacements['MajoraNamespace']))
                    ->notContains(sprintf('// %s aliases', $replacements['MajoraEntity']))
                ,
                'callback' => function (SplFileInfo $file) use ($entity, $namespace, $replacements) {
                    return str_replace(
        '// aliases',
        '// aliases

        // '. $replacements['MajoraEntity'] .' aliases
        $this->registerAliases($container, \'sir.'. $replacements['majora_entity'] .'\', $config[\''. $replacements['majora_entity'] .'\']);'
                        ,
                        $file->getContents()
                    );
                }
            ),

            // routing
            array(
                'finder' => (new Finder)
                    ->in($this->targetPath)
                    ->name('routing_api.yml')
                    ->notContains(sprintf('# %s Api', $replacements['MajoraEntity']))
                ,
                'callback' => function (SplFileInfo $file) use ($entity, $namespace, $replacements) {
                    return $file->getContents().
                    '
# '. $replacements['MajoraEntity'] .' Api
'. $replacements['majora_entity'] . '_rest_api:
    resource: "@SirSdk'. $replacements['MajoraNamespace'] .'Bundle/Resources/config/routing/'. $replacements['majora_entity'] . '_api.yml"
    prefix:   /'. $replacements['majora_entity'] . 's
'
                    ;
                }
            ),

            // kernel
            array(
                'finder' => (new Finder)
                    ->in($this->projectBasePath.'/app')
                    ->name('AppKernel.php')
                ,
                'callback' => function (SplFileInfo $file) use ($entity, $namespace, $replacements) {
                    return $entity != $namespace ?
                        $file->getContents() :
                        str_replace(
            'new Majora\Bundle\FrameworkExtraBundle\MajoraFrameworkExtraBundle(),',
            'new Majora\Bundle\FrameworkExtraBundle\MajoraFrameworkExtraBundle(),
            new SirSdk\Bundle\\'. $replacements['MajoraNamespace'] .'Bundle\SirSdk'. $replacements['MajoraNamespace'] .'Bundle(),'
                        ,
                        str_replace(
                            '
        );

        if (in_array($this->getEnvironment(), array(\'dev\', \'test\'))) {',
                            '
            new Sir\Bundle\\'. $replacements['MajoraNamespace'] .'Bundle\Sir'. $replacements['MajoraNamespace'] .'Bundle(),
        );

        if (in_array($this->getEnvironment(), array(\'dev\', \'test\'))) {',
                            $file->getContents()
                        )
                    );
                }
            ),

            // main routing
            array(
                'finder' => (new Finder)
                    ->in($this->projectBasePath.'/app/config')
                    ->name('routing_api.yml')
                ,
                'callback' => function (SplFileInfo $file) use ($entity, $namespace, $replacements) {
                    return $entity != $namespace ?
                        $file->getContents() :
                        $file->getContents().
                    '
# '. $replacements['MajoraNamespace'] .' api routing
'. $replacements['majora_namespace'] . '_api:
    resource: "@SirSdk'. $replacements['MajoraNamespace'] .'Bundle/Resources/config/routing_api.yml"
'
                    ;
                }
            ),
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
