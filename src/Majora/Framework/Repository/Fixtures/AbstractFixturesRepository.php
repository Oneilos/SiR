<?php

namespace Majora\Framework\Repository\Fixtures;

use InvalidArgumentException;
use Majora\Framework\Model\EntityCollection;
use Majora\Framework\Repository\RepositoryInterface;
use RuntimeException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Base class for fixtures repository.
 */
abstract class AbstractFixturesRepository implements RepositoryInterface
{
    use FixturesRepositoryTrait;
}
