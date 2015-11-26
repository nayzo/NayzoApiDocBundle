<?php
namespace Nayzo\ApiDocBundle\Tests\Fixtures\Model;

use JMS\Serializer\Annotation as JMS;

class JmsChild extends JmsTest
{
    /**
     * @JMS\Type("string");
     */
    public $child;

}
