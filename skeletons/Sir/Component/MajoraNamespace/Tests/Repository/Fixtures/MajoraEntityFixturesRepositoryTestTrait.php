<?php
/* majora_generator.force_generation: true */

namespace Sir\Component\MajoraNamespace\Tests\Repository\Fixtures;

use Prophecy\Argument;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntityCollection;
use Sir\Component\MajoraNamespace\Repository\Fixtures\MajoraEntityFixturesRepository;

/**
 * Tests traits for MajoraEntityFixturesRepositoryTest PHPUnit test case class.
 */
trait MajoraEntityFixturesRepositoryTestTrait
{
    private function createRepository(&$serializer = null)
    {
        $serializer = $this->prophesize('Majora\Framework\Serializer\MajoraSerializer');
        $serializer->deserialize(Argument::any(), Argument::any(), Argument::any())
            ->willReturn(new MajoraEntityCollection(array(
                3  => (new MajoraEntity())->setId(3),
                14 => (new MajoraEntity())->setId(14),
                15 => (new MajoraEntity())->setId(15),
            )))
            ->shouldBeCalled()
        ;

        $repository = new MajoraEntityFixturesRepository();
        $repository->setUp(array(), 'SirSdk\Component\MajoraNamespace\Model\MajoraEntityCollection', $serializer->reveal());

        return $repository;
    }

    /**
     * test save() method.
     */
    public function testSave()
    {
        $repository = $this->createRepository();
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
        $repository = $this->createRepository();
        $entity     = new MajoraEntity();

        $this->assertEquals(
            $entity,
            $repository->delete($entity),
            'Repository returns deleted object.'
        );
    }
}
