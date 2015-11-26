<?php

/*
 * This file is part of the NayzoApiDocBundle.
 *
 * (c) Nayzo <alakhefifi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nayzo\ApiDocBundle\Extractor;

use Nayzo\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Routing\Route;

interface HandlerInterface
{
    /**
     * Parse route parameters in order to populate ApiDoc.
     *
     * @param \Nayzo\ApiDocBundle\Annotation\ApiDoc $annotation
     * @param array                                  $annotations
     * @param \Symfony\Component\Routing\Route       $route
     * @param \ReflectionMethod                      $method
     */
    public function handle(ApiDoc $annotation, array $annotations, Route $route, \ReflectionMethod $method);
}
