<?php
/* majora_generator.force_generation: true */

namespace SirSdk\Component\Partner\Tests\Domain\Api;

use SirSdk\Component\Partner\Domain\Api\PartnerApiDomain;
use SirSdk\Component\Partner\Model\Partner;

/**
 * Tests traits for PartnerApiDomainTest PHPUnit test case class.
 */
trait PartnerApiDomainTestTrait
{
    /**
     * tests create() method.
     */
    public function testCreate()
    {
        $partner = new Partner();
        $partner->setId(42);

        $repository = $this->prophesize('SirSdk\Component\Partner\Repository\Api\PartnerApiRepository');
        $repository->save($partner)->shouldBeCalled();

        $validator = $this->prophesize('Symfony\Component\Validator\ValidatorInterface');
        $validator->validate($partner, array('creation'))->shouldBeCalled();

        $domain = new PartnerApiDomain($repository->reveal());
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

        $repository = $this->prophesize('SirSdk\Component\Partner\Repository\Api\PartnerApiRepository');
        $repository->save($partner)->shouldBeCalled();

        $validator = $this->prophesize('Symfony\Component\Validator\ValidatorInterface');
        $validator->validate($partner, array('edition'))->shouldBeCalled();

        $domain = new PartnerApiDomain($repository->reveal());
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

        $repository = $this->prophesize('SirSdk\Component\Partner\Repository\Api\PartnerApiRepository');
        $repository->delete($partner)->shouldBeCalled();

        $validator = $this->prophesize('Symfony\Component\Validator\ValidatorInterface');
        $validator->validate($partner, array('deletion'))->shouldBeCalled();

        $domain = new PartnerApiDomain($repository->reveal());
        $domain->setValidator($validator->reveal());

        $domain->delete($partner);
    }
}
