<?php
/*
* This file is part of the NayzoApiDocBundle.
*
* (c) Nayzo <alakhefifi@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Nayzo\ApiDocBundle\Tests\Extractor;

use Nayzo\ApiDocBundle\Tests\WebTestCase;

class SensioFrameworkExtraHandlerTest extends WebTestCase
{
    public function testCacheAnnotation()
    {
        $container  = $this->getContainer();
        $extractor  = $container->get('nayzo_api_doc.extractor.api_doc_extractor');
        $annotation = $extractor->get('Nayzo\ApiDocBundle\Tests\Fixtures\Controller\TestController::zCachedAction', 'test_route_23');

        $this->assertNotNull($annotation);

        $this->assertSame(60, $annotation->getCache());
    }

    public function testSecurityAnnotation()
    {
        $container  = $this->getContainer();
        $extractor  = $container->get('nayzo_api_doc.extractor.api_doc_extractor');
        $annotation = $extractor->get('Nayzo\ApiDocBundle\Tests\Fixtures\Controller\TestController::zSecuredAction', 'test_route_24');

        $this->assertNotNull($annotation);

        $this->assertTrue($annotation->getAuthentication());
    }
}
