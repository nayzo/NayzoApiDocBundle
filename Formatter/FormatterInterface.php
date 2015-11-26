<?php

/*
 * This file is part of the NayzoApiDocBundle.
 *
 * (c) Nayzo <alakhefifi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nayzo\ApiDocBundle\Formatter;

use Nayzo\ApiDocBundle\Annotation\ApiDoc;

interface FormatterInterface
{
    /**
     * Format a collection of documentation data.
     *
     * @param  array[ApiDoc] $collection
     * @return string|array
     */
    public function format(array $collection);

    /**
     * Format documentation data for one route.
     *
     * @param ApiDoc $annotation
     *                           return string|array
     */
    public function formatOne(ApiDoc $annotation);
}
