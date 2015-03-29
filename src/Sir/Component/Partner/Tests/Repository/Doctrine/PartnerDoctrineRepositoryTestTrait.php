<?php
/* majora_generator.force_generation: true */

namespace Sir\Component\Partner\Tests\Repository\Doctrine;

use SirSdk\Component\Partner\Model\Partner;
use Sir\Component\Partner\Repository\Doctrine\PartnerDoctrineRepository;

/**
 * Tests traits for PartnerDoctrineRepositoryTest PHPUnit test case class.
 */
trait PartnerDoctrineRepositoryTestTrait
{
    /**
     * test save() method.
     */
    public function testSave()
    {
        $entity = new Partner();

        $em = $this->prophesize('Doctrine\ORM\EntityManager');
        $em->persist($entity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $repository = new PartnerDoctrineRepository(
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
        $entity = new Partner();

        $em = $this->prophesize('Doctrine\ORM\EntityManager');
        $em->remove($entity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $repository = new PartnerDoctrineRepository(
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
