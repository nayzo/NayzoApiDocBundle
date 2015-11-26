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

/**
 * Interface for annotations providers.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
interface AnnotationsProviderInterface
{
    /**
     * Returns an array ApiDoc annotations.
     *
     * @return \Nayzo\ApiDocBundle\Annotation\ApiDoc[]
     */
    public function getAnnotations();
}
