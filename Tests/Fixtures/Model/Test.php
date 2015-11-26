<?php

/*
 * This file is part of the NayzoApiDocBundle.
 *
 * (c) Nayzo <alakhefifi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nayzo\ApiDocBundle\Tests\Fixtures\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Test
{
    /**
     * @Assert\Length(min="foo");
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    public $a = 'nayzo';

    /**
     * @Assert\Type("DateTime");
     */
    public $b;

    public $c;
}
