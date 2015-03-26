<?php
/* majora_generator.force_generation: true */

namespace SirSdk\Component\MajoraNamespace\Tests\Repository\Api;

use SirSdk\Component\MajoraNamespace\Repository\Api\MajoraEntityApiRepository;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;

/**
 * Tests traits for MajoraEntityRepositoryTest PHPUnit test case class.
 */
trait MajoraEntityApiRepositoryTestTrait
{
    /**
     * test save() method.
     */
    public function testSave()
    {
        $repository = new MajoraEntityApiRepository();
        $entity     = new MajoraEntity();

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
        $repository = new MajoraEntityApiRepository();
        $entity     = new MajoraEntity();

        $this->assertEquals(
            $entity,
            $repository->delete($entity),
            'Repository returns deleted object.'
        );
    }
}
