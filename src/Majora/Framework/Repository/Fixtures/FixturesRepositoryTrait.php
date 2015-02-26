<?php

namespace Majora\Framework\Repository\Fixtures;

use InvalidArgumentException;
use Majora\Framework\Model\CollectionableInterface;
use RuntimeException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Base trait for fixtures repository.
 */
trait FixturesRepositoryTrait
{
    protected $data;

    protected $sourceFile;
    protected $collectionClass;

    protected $fileLocator;
    protected $serializer;

    /**
     * setUp method.
     *
     * @param FileLocator         $fileLocator
     * @param SerializerInterface $serializer
     */
    public function setUp(
        FileLocator         $fileLocator,
        SerializerInterface $serializer
    ) {
        $this->fileLocator = $fileLocator;
        $this->serializer  = $serializer;
    }

    /**
     * define source file for given repository.
     *
     * @param string $sourceFile
     * @param string $collectionClass
     */
    public function setSource($sourceFile, $collectionClass)
    {
        $this->sourceFile      = $sourceFile;
        $this->collectionClass = $collectionClass;

        if (empty($collectionClass) || !class_exists($collectionClass)) {
            throw new InvalidArgumentException(sprintf(
                'You must provide a valid class name, "%s" given.',
                $collectionClass
            ));
        }

        return $this;
    }

    /**
     * load repository data from source.
     *
     * @throws RuntimeException If not initialized properly
     */
    private function loadData()
    {
        if (!$this->fileLocator || !$this->serializer) {
            throw new RuntimeException(sprintf(
                '%s methods cannot be used, it hasnt been initialize through setUp() method.',
                __CLASS__
            ));
        }

        $this->data = $this->serializer->deserialize(
            $this->fileLocator->locate($this->sourceFile),
            $this->collectionClass,
            'yaml'
        );
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

        return;
    }

    /**
     * @see RepositoryInterface::persist()
     */
    public function persist(CollectionableInterface $entity)
    {
        $this->loadData();

        return;
    }

    /**
     * @see RepositoryInterface::remove()
     */
    public function remove(CollectionableInterface $entity)
    {
        $this->loadData();

        return;
    }
}
