<?php

namespace Nayzo\ApiDocBundle\Tests\Fixtures\Model;

use JMS\Serializer\Annotation as JMS;

class JmsTest
{
    public $nothing;

    /**
     * @JMS\Type("string");
     */
    public $foo;

    /**
     * @JMS\Type("DateTime");
     * @JMS\ReadOnly
     */
    public $bar;

    /**
     * @JMS\Type("double");
     * @JMS\SerializedName("number");
     */
    public $baz;

    /**
     * @JMS\Type("array");
     */
    public $arr;

    /**
     * @JMS\Type("Nayzo\ApiDocBundle\Tests\Fixtures\Model\JmsNested");
     */
    public $nested;

    /**
     * @JMS\Type("array<Nayzo\ApiDocBundle\Tests\Fixtures\Model\JmsNested>");
     */
    public $nestedArray;

    /**
     * @JMS\Groups("hidden")
     */
    public $hidden;
}
