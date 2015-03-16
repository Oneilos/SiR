<?php

namespace Majora\Framework\Serializer\Tests;

use mageekguy\atoum\test;
use StdClass;

/**
 * Atoum test for Majora serializer.
 *
 * @namespace \Tests
 */
class MajoraSerializer extends test
{
    /**
     * tests serialize methods without any handler defined.
     */
    public function testSerializeWithoutHandlers()
    {
        $this
            ->given($serializer = $this->newTestedInstance(array()))
            ->exception(function () use ($serializer) {
                $serializer->serialize(new StdClass(), 'test');
            })
                ->isInstanceOf('BadMethodCallException')
                ->message
                    ->matches('#Unsupported format "test"*#')
        ;
    }

    /**
     * tests serialize cases.
     *
     * @dataProvider serializeProvider
     */
    public function testSerialize(
        $calledHandler, $neverCalledHandler,
        $givenScope, $executedScope
    ) {
        $this
            ->given($serializer = $this->newTestedInstance(array(
                'yaml' => $neverCalledHandler,
                'json' => $calledHandler,
            )))
            ->and($context = $givenScope ? array('scope' => $givenScope) : array())
            ->and($data    = $serializer->serialize('123', 'json', $context))
            ->then
                ->string($data)->isEqualTo('123')
                ->mock($neverCalledHandler)
                    ->call('serialize')->never()
                ->mock($calledHandler)
                    ->call('serialize')
                        ->withArguments('123', $executedScope)
                        ->once()
        ;
    }

    public function serializeProvider()
    {
        $cases = array();

        // 2 handlers, given scope
        $calledHandler = new \mock\Majora\Framework\Serializer\Handler\FormatHandlerInterface();
        $this->calling($calledHandler)->serialize = function ($data, $scope) {
            return $data;
        };
        $neverCalledHandler = new \mock\Majora\Framework\Serializer\Handler\FormatHandlerInterface();

        $cases[] = array($calledHandler, $neverCalledHandler, 'scope', 'scope');

        // 2 handlers, default scope
        $calledHandler = new \mock\Majora\Framework\Serializer\Handler\FormatHandlerInterface();
        $this->calling($calledHandler)->serialize = function ($data, $scope) {
            return $data;
        };
        $neverCalledHandler = new \mock\Majora\Framework\Serializer\Handler\FormatHandlerInterface();

        $cases[] = array($calledHandler, $neverCalledHandler, null, 'default');

        return $cases;
    }
}
