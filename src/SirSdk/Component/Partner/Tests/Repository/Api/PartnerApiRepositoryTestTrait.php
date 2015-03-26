<?php
/* majora_generator.force_generation: true */

namespace SirSdk\Component\Partner\Tests\Repository\Api;

use SirSdk\Component\Partner\Repository\Api\PartnerApiRepository;
use SirSdk\Component\Partner\Model\Partner;

/**
 * Tests traits for PartnerRepositoryTest PHPUnit test case class.
 */
trait PartnerApiRepositoryTestTrait
{
    /**
     * test save() method.
     */
    public function testSave()
    {
        $repository = new PartnerApiRepository();
        $entity     = new Partner();

        $this->assertEquals(
            $entity,
            $repository->save($entity),
            'Repository returns saved object.'
        );
    }

    /**
     * test delete() method.
     */
    public function testDelete()
    {
        $repository = new PartnerApiRepository();
        $entity     = new Partner();

        $this->assertEquals(
            $entity,
            $repository->delete($entity),
            'Repository returns deleted object.'
        );
    }
}
