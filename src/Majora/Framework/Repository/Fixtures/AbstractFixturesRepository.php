<?php

namespace Majora\Framework\Repository\Fixtures;

use InvalidArgumentException;
use Majora\Framework\Model\BaseEntityCollection;
use Majora\Framework\Model\SerializableInterface;
use Majora\Framework\Repository\RepositoryInterface;
use RuntimeException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

/**
 * Base class for fixtures repository
 *
 * @package majora-framework
 * @subpackage repository
 */
abstract class AbstractFixturesRepository implements RepositoryInterface
{
    protected $data;

    protected $sourceFile;

    protected $fileLocator;
    protected $parser;
    protected $serializer;

    /**
     * setUp method
     *
     * @param Yaml                $parser
     * @param FileLocator         $fileLocator
     * @param SerializerInterface $serializer
     */
    public function setUp(
        Yaml        $parser,
        FileLocator $fileLocator,
        $serializer   // not hinted volontary atm (sf, jms, majora wont be have same interface)
    )
    {
        $this->fileLocator = $fileLocator;
        $this->parser      = $parser;
        $this->serializer  = $serializer;
    }

    /**
     * define source file for given repository
     *
     * @param string $sourceFile
     */
    public function setSource($sourceFile)
    {
        $this->sourceFile = $sourceFile;

        return $this;
    }

    /**
     * load repository data from source
     *
     * @throws RuntimeException If not initialized properly
     */
    private function loadData()
    {
        if (!$this->fileLocator || !$this->parser || !$this->serializer) {
            throw new RuntimeException(sprintf(
                '%s methods cannot be used, it hasnt been initialize through setUp() method.',
                __CLASS__
            ));
        }

        $dataConfig = $this->parser->parse(
            $this->fileLocator->locate($this->sourceFile)
        );

        if (empty($dataConfig['entity']) || !class_exists($dataConfig['entity'])) {
            throw new InvalidArgumentException(sprintf(
                'You must provide a valid class name under "entity" key into "%s" file.',
                $this->sourceFile
            ));
        }
        if (empty($dataConfig['collection']) || !class_exists($dataConfig['collection'])) {
            throw new InvalidArgumentException(sprintf(
                'You must provide a valid class name under "collection" key into "%s" file.',
                $this->sourceFile
            ));
        }

        $entityClass     = $dataConfig['entity'];
        $collectionClass = $dataConfig['collection'];
        $data            = empty($dataConfig['data']) ? array() : $dataConfig['data'];

        $this->data = new $collectionClass();
        if (!$this->data instanceof BaseEntityCollection) {
            throw new InvalidArgumentException(sprintf(
                'You must provide a Majora\Framework\Model\BaseEntityCollection class name under "collection" key into "%s" file.',
                $this->sourceFile
            ));
        }

        foreach ($data as $id => $properties) {
            $entity = new $entityClass();
            if (!$entity instanceof SerializableInterface) {
                throw new InvalidArgumentException(sprintf(
                    'You must provide a Majora\Framework\Model\SerializableInterface class name under "entity" key into "%s" file.',
                    $this->sourceFile
                ));
            }
            $entity->fromArray($properties);
            $this->data->set($entity->getId(), $entity);
        }
    }

    /**
     * @see LoaderInterface::retrieveAll()
     */
    public function retrieveAll(array $filters = array(), $limit = null, $offset = null)
    {
        $this->loadData();

        $result = $this->data;
        if (!empty($filters)) {
            $result = $result->search($filters);
        }
        if ($offset) {
            $result = $result->slice($offset, $limit);
        }
        if ($limit) {
            $result = $result->chunk($limit);
        }

        return $result;
    }

    /**
     * @see LoaderInterface::retrieve()
     */
    public function retrieve($id)
    {
        $this->loadData();

        return null;
    }

    /**
     * @see RepositoryInterface::persist()
     */
    public function persist($entity)
    {
        $this->loadData();

        return;
    }

    /**
     * @see RepositoryInterface::remove()
     */
    public function remove($entity)
    {
        $this->loadData();

        return;
    }
}
