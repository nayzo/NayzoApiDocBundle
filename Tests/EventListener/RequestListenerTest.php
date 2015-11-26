<?php

/*
 * This file is part of the NayzoApiDocBundle.
 *
 * (c) Nayzo <alakhefifi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nayzo\ApiDocBundle\Tests\EventListener;

use Nayzo\ApiDocBundle\Tests\WebTestCase;

class RequestListenerTest extends WebTestCase
{
    public function testDocQueryArg()
    {
        $client = $this->createClient();

        $client->request('GET', '/tests?_doc=1');
        $content = $client->getResponse()->getContent();
        $this->assertTrue(0 !== strpos($content, '<h1>API documentation</h1>'), 'Event listener should capture ?_doc=1 requests');
        $this->assertTrue(0 !== strpos($content, '/tests.{_format}'), 'Event listener should capture ?_doc=1 requests');

        $client->request('GET', '/tests');
        $this->assertEquals('tests', $client->getResponse()->getContent(), 'Event listener should let normal requests through');
    }
}
