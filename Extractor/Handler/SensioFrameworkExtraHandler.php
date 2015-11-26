<?php

/*
 * This file is part of the NayzoApiDocBundle.
 *
 * (c) Nayzo <alakhefifi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nayzo\ApiDocBundle\Extractor\Handler;

use Nayzo\ApiDocBundle\Extractor\HandlerInterface;
use Nayzo\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Routing\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class SensioFrameworkExtraHandler implements HandlerInterface
{
    public function handle(ApiDoc $annotation, array $annotations, Route $route, \ReflectionMethod $method)
    {
        foreach ($annotations as $annot) {
            if ($annot instanceof Cache) {
                $annotation->setCache($annot->getMaxAge());
            } elseif ($annot instanceof Security) {
                $annotation->setAuthentication(true);
            }
        }
    }
}
