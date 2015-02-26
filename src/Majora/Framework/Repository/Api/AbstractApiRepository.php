<?php

namespace Majora\Framework\Repository\Api;

use Majora\Framework\Repository\RepositoryInterface;

/**
 * Base class for api repository.
 */
abstract class AbstractApiRepository implements RepositoryInterface
{
    use ApiRepositoryTrait;
}
