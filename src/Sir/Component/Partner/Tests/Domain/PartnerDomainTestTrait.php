<?php
/* majora_generator.force_generation: true */

namespace Sir\Component\Partner\Tests\Domain;

use SirSdk\Component\Partner\Model\Partner;
use Sir\Component\Partner\Domain\PartnerDomain;
use Sir\Component\Partner\Event\PartnerEvent;
use Sir\Component\Partner\Event\PartnerEvents;

/**
 * Tests traits for PartnerDomainTest PHPUnit test case class.
 */
trait PartnerDomainTestTrait
{
    /**
     * tests create() method.
     */
    public function testCreate()
    {
        $partner = new Partner();
        $partner->setId(42);

        $repository = $this->prophesize('SirSdk\Component\Partner\Repository\PartnerRepositoryInterface');
        $repository->save($partner)->shouldBeCalled();

        $asserter = $this;

        $eventDispatcher = $this->prophesize('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $eventDispatcher
            ->dispatch(
                PartnerEvents::SIR_PARTNER_CREATED,
                new PartnerEvent($partner)
            )
            ->will(function ($args) use ($partner, $asserter) {
                $asserter->assertEquals($partner, $args[1]->getPartner());
                $asserter->assertEquals(array('partner_id' => 42), $args[1]->getData());
            })
            ->shouldBeCalled()
        ;

        $validator = $this->prophesize('Symfony\Component\Validator\ValidatorInterface');
        $validator->validate($partner, array('creation'))->shouldBeCalled();

        $domain = new PartnerDomain($repository->reveal());
        $domain->setEventDispatcher($eventDispatcher->reveal());
        $domain->setValidator($validator->reveal());

        $domain->create($partner);
    }

    /**
     * tests edit() method.
     */
    public function testEdit()
    {
        $partner = new Partner();
        $partner->setId(42);

        $repository = $this->prophesize('SirSdk\Component\Partner\Repository\PartnerRepositoryInterface');
        $repository->save($partner)->shouldBeCalled();

        $eventDispatcher = $this->prophesize('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $eventDispatcher
            ->dispatch(
                PartnerEvents::SIR_PARTNER_EDITED,
                new PartnerEvent($partner)
            )
            ->shouldBeCalled()
        ;

        $validator = $this->prophesize('Symfony\Component\Validator\ValidatorInterface');
        $validator->validate($partner, array('edition'))->shouldBeCalled();

        $domain = new PartnerDomain($repository->reveal());
        $domain->setEventDispatcher($eventDispatcher->reveal());
        $domain->setValidator($validator->reveal());

        $domain->edit($partner);
    }

    /**
     * tests delete() method.
     */
    public function testDelete()
    {
        $partner = new Partner();
        $partner->setId(42);

        $repository = $this->prophesize('SirSdk\Component\Partner\Repository\PartnerRepositoryInterface');
        $repository->delete($partner)->shouldBeCalled();

        $eventDispatcher = $this->prophesize('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $eventDispatcher
            ->dispatch(
                PartnerEvents::SIR_PARTNER_DELETED,
                new PartnerEvent($partner)
            )
            ->shouldBeCalled()
        ;

        $validator = $this->prophesize('Symfony\Component\Validator\ValidatorInterface');
        $validator->validate($partner, array('deletion'))->shouldBeCalled();

        $domain = new PartnerDomain($repository->reveal());
        $domain->setEventDispatcher($eventDispatcher->reveal());
        $domain->setValidator($validator->reveal());

        $domain->delete($partner);
    }
}
