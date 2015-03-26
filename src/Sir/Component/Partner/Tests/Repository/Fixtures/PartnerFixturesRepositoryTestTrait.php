<?php
/* majora_generator.force_generation: true */

namespace Sir\Component\Partner\Tests\Repository\Fixtures;

use Prophecy\Argument;
use SirSdk\Component\Partner\Model\Partner;
use SirSdk\Component\Partner\Model\PartnerCollection;
use Sir\Component\Partner\Repository\Fixtures\PartnerFixturesRepository;

/**
 * Tests traits for PartnerFixturesRepositoryTest PHPUnit test case class.
 */
trait PartnerFixturesRepositoryTestTrait
{
    private function createRepository(&$serializer = null)
    {
        $serializer = $this->prophesize('Majora\Framework\Serializer\MajoraSerializer');
        $serializer->deserialize(Argument::any(), Argument::any(), Argument::any())
            ->willReturn(new PartnerCollection(array(
                3  => (new Partner())->setId(3),
                14 => (new Partner())->setId(14),
                15 => (new Partner())->setId(15),
            )))
            ->shouldBeCalled()
        ;

        $repository = new PartnerFixturesRepository();
        $repository->setUp(array(), 'SirSdk\Component\Partner\Model\PartnerCollection', $serializer->reveal());

        return $repository;
    }

    /**
     * test save() method.
     */
    public function testSave()
    {
        $repository = $this->createRepository();
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
        $repository = $this->createRepository();
        $entity     = new Partner();

        $this->assertEquals(
            $entity,
            $repository->delete($entity),
            'Repository returns deleted object.'
        );
    }
}
