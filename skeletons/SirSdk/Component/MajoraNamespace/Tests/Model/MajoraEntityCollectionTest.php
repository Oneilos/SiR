<?php

namespace SirSdk\Component\MajoraNamespace\Tests\Model;

use PHPUnit_Framework_TestCase;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntity;
use SirSdk\Component\MajoraNamespace\Model\MajoraEntityCollection;

/**
 * Unit test class for MajoraEntityCollection.php.
 *
 * @see SirSdk\Component\MajoraNamespace\Model\MajoraEntityCollection
 */
class MajoraEntityCollectionTest
    extends PHPUnit_Framework_TestCase
{
    /**
     * tests deserialize() method.
     */
    public function testDeserialize()
    {
        $collection = new MajoraEntityCollection();
        $collection->deserialize(array(
            array('id' => 3),
            array('id' => 14),
            array('id' => 15),
        ));

        $this->assertEquals(
            new MajoraEntityCollection(array(
                3  => (new MajoraEntity())->setId(3),
                14 => (new MajoraEntity())->setId(14),
                15 => (new MajoraEntity())->setId(15),
            )),
            $collection,
            'MajoraEntityCollection from serialization is same has if it was initialized with full filled MajoraEntity.'
        );
    }
}
