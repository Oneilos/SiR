<?php

namespace Majora\Framework\Repository\Api;

use Doctrine\ORM\EntityRepository;
use Majora\Framework\Repository\RepositoryInterface;

/**
 * Base class for doctrine repository
 *
 * @package majora-framework
 * @subpackage repository
 */
class BaseDoctrineRepository
    extends EntityRepository
    implements RepositoryInterface
{
    use DoctrineRepositoryTrait;
}
