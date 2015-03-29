<?php
/* majora_generator.force_generation: true */

namespace Sir\Component\MajoraNamespace\Tests\Repository\Doctrine;

use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;
use Sir\Component\MajoraNamespace\Repository\Doctrine\MajoraEntityDoctrineRepository;

/**
 * Tests traits for MajoraEntityDoctrineRepositoryTest PHPUnit test case class.
 */
trait MajoraEntityDoctrineRepositoryTestTrait
{
    /**
     * test save() method.
     */
    public function testSave()
    {
        $entity = new MajoraEntity();

        $em = $this->prophesize('Doctrine\ORM\EntityManager');
        $em->persist($entity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $repository = new MajoraEntityDoctrineRepository(
            $em->reveal(),
            $this->prophesize('Doctrine\ORM\Mapping\ClassMetadata')->reveal()
        );

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
        $entity = new MajoraEntity();

        $em = $this->prophesize('Doctrine\ORM\EntityManager');
        $em->remove($entity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $repository = new MajoraEntityDoctrineRepository(
            $em->reveal(),
            $this->prophesize('Doctrine\ORM\Mapping\ClassMetadata')->reveal()
        );

        $this->assertEquals(
            $entity,
            $repository->delete($entity),
            'Repository returns deleted object.'
        );
    }
}
