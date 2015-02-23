<?php

namespace Majora\Framework\Repository\Fixtures;

use InvalidArgumentException;
use Majora\Framework\Model\BaseEntityCollection;
use Majora\Framework\Model\SerializableInterface;
use Majora\Framework\Repository\RepositoryInterface;
use RuntimeException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Base class for fixtures repository
 *
 * @package majora-framework
 * @subpackage repository
 */
abstract class AbstractFixturesRepository implements RepositoryInterface
{
    use FixturesRepositoryTrait;
}
