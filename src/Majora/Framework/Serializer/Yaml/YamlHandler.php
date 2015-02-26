<?php

namespace Majora\Framework\Serializer\Yaml;

use Majora\Framework\Serializer\Collection\CollectionHandler;
use Majora\Framework\Serializer\FormatHandlerInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Handler implementation creating and using yaml
 *
 * @package majora-framework
 * @subpackage serializer
 */
class YamlHandler
    extends CollectionHandler
{
    protected $yamlParser;

    /**
     * construct
     *
     * @param Yaml $yamlParser
     */
    public function __construct(Yaml $yamlParser)
    {
        $this->yamlParser = $yamlParser;
    }

    /**
     * @see FormatHandlerInterface::serialize()
     */
    public function serialize($data, $scope)
    {
        return $this->yamlParser->dump(
            parent::serialize($data, $scope)
        );
    }

    /**
     * @see FormatHandlerInterface::deserialize()
     */
    public function deserialize($data, $output)
    {
        return parent::deserialize(
            $this->yamlParser->parse($data),
            $output
        );
    }
}
