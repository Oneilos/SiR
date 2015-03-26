<?php

namespace SirSdk\Component\Partner\Tests\Model;

use PHPUnit_Framework_TestCase;
use SirSdk\Component\Partner\Model\Partner;
use SirSdk\Component\Partner\Model\PartnerCollection;

/**
 * Unit test class for PartnerCollection.php.
 *
 * @see SirSdk\Component\Partner\Model\PartnerCollection
 */
class PartnerCollectionTest
    extends PHPUnit_Framework_TestCase
{
    /**
     * tests deserialize() method.
     */
    public function testDeserialize()
    {
        $collection = new PartnerCollection();
        $collection->deserialize(array(
            array('id' => 3),
            array('id' => 14),
            array('id' => 15),
        ));

        $this->assertEquals(
            new PartnerCollection(array(
                3  => (new Partner())->setId(3),
                14 => (new Partner())->setId(14),
                15 => (new Partner())->setId(15),
            )),
            $collection,
            'PartnerCollection from serialization is same has if it was initialized with full filled Partner.'
        );
    }
}
