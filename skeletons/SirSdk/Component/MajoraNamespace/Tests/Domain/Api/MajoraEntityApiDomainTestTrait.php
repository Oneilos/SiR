<?php
/* majora_generator.force_generation: true */

namespace SirSdk\Component\MajoraNamespace\Tests\Domain\Api;

use SirSdk\Component\MajoraNamespace\Domain\Api\MajoraEntityApiDomain;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;

/**
 * Tests traits for MajoraEntityApiDomainTest PHPUnit test case class.
 */
trait MajoraEntityApiDomainTestTrait
{
    /**
     * tests create() method.
     */
    public function testCreate()
    {
        $majoraEntity = new MajoraEntity();
        $majoraEntity->setId(42);

        $repository = $this->prophesize('SirSdk\Component\MajoraNamespace\Repository\Api\MajoraEntityApiRepository');
        $repository->save($majoraEntity)->shouldBeCalled();

        $validator = $this->prophesize('Symfony\Component\Validator\ValidatorInterface');
        $validator->validate($majoraEntity, array('creation'))->shouldBeCalled();

        $domain = new MajoraEntityApiDomain($repository->reveal());
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

        $repository = $this->prophesize('SirSdk\Component\MajoraNamespace\Repository\Api\MajoraEntityApiRepository');
        $repository->save($majoraEntity)->shouldBeCalled();

        $validator = $this->prophesize('Symfony\Component\Validator\ValidatorInterface');
        $validator->validate($majoraEntity, array('edition'))->shouldBeCalled();

        $domain = new MajoraEntityApiDomain($repository->reveal());
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

        $repository = $this->prophesize('SirSdk\Component\MajoraNamespace\Repository\Api\MajoraEntityApiRepository');
        $repository->delete($majoraEntity)->shouldBeCalled();

        $validator = $this->prophesize('Symfony\Component\Validator\ValidatorInterface');
        $validator->validate($majoraEntity, array('deletion'))->shouldBeCalled();

        $domain = new MajoraEntityApiDomain($repository->reveal());
        $domain->setValidator($validator->reveal());

        $domain->delete($majoraEntity);
    }
}
