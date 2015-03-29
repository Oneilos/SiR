<?php
/* majora_generator.force_generation: true */

namespace Sir\Component\MajoraNamespace\Tests\Domain;

use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;
use Sir\Component\MajoraNamespace\Domain\MajoraEntityDomain;
use Sir\Component\MajoraNamespace\Event\MajoraEntityEvent;
use Sir\Component\MajoraNamespace\Event\MajoraEntityEvents;

/**
 * Tests traits for MajoraEntityDomainTest PHPUnit test case class.
 */
trait MajoraEntityDomainTestTrait
{
    /**
     * tests create() method.
     */
    public function testCreate()
    {
        $majoraEntity = new MajoraEntity();
        $majoraEntity->setId(42);

        $repository = $this->prophesize('SirSdk\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface');
        $repository->save($majoraEntity)->shouldBeCalled();

        $asserter = $this;

        $eventDispatcher = $this->prophesize('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $eventDispatcher
            ->dispatch(
                MajoraEntityEvents::SIR_MAJORA_ENTITY_CREATED,
                new MajoraEntityEvent($majoraEntity)
            )
            ->will(function ($args) use ($majoraEntity, $asserter) {
                $asserter->assertEquals($majoraEntity, $args[1]->getMajoraEntity());
                $asserter->assertEquals(array('majora_entity_id' => 42), $args[1]->getData());
            })
            ->shouldBeCalled()
        ;

        $validator = $this->prophesize('Symfony\Component\Validator\ValidatorInterface');
        $validator->validate($majoraEntity, array('creation'))->shouldBeCalled();

        $domain = new MajoraEntityDomain($repository->reveal());
        $domain->setEventDispatcher($eventDispatcher->reveal());
        $domain->setValidator($validator->reveal());

        $domain->create($majoraEntity);
    }

    /**
     * tests edit() method.
     */
    public function testEdit()
    {
        $majoraEntity = new MajoraEntity();
        $majoraEntity->setId(42);

        $repository = $this->prophesize('SirSdk\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface');
        $repository->save($majoraEntity)->shouldBeCalled();

        $eventDispatcher = $this->prophesize('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $eventDispatcher
            ->dispatch(
                MajoraEntityEvents::SIR_MAJORA_ENTITY_EDITED,
                new MajoraEntityEvent($majoraEntity)
            )
            ->shouldBeCalled()
        ;

        $validator = $this->prophesize('Symfony\Component\Validator\ValidatorInterface');
        $validator->validate($majoraEntity, array('edition'))->shouldBeCalled();

        $domain = new MajoraEntityDomain($repository->reveal());
        $domain->setEventDispatcher($eventDispatcher->reveal());
        $domain->setValidator($validator->reveal());

        $domain->edit($majoraEntity);
    }

    /**
     * tests delete() method.
     */
    public function testDelete()
    {
        $majoraEntity = new MajoraEntity();
        $majoraEntity->setId(42);

        $repository = $this->prophesize('SirSdk\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface');
        $repository->delete($majoraEntity)->shouldBeCalled();

        $eventDispatcher = $this->prophesize('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $eventDispatcher
            ->dispatch(
                MajoraEntityEvents::SIR_MAJORA_ENTITY_DELETED,
                new MajoraEntityEvent($majoraEntity)
            )
            ->shouldBeCalled()
        ;

        $validator = $this->prophesize('Symfony\Component\Validator\ValidatorInterface');
        $validator->validate($majoraEntity, array('deletion'))->shouldBeCalled();

        $domain = new MajoraEntityDomain($repository->reveal());
        $domain->setEventDispatcher($eventDispatcher->reveal());
        $domain->setValidator($validator->reveal());

        $domain->delete($majoraEntity);
    }
}
