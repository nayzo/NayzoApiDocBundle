<?php
/**
 * Created by mcfedr on 30/06/15 21:05
 */

namespace Nayzo\ApiDocBundle\Tests\Fixtures\Model;

class JsonSerializableRequiredConstructorTest implements \JsonSerializable
{
    public function __construct($required)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return array();
    }
}
