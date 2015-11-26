<?php

/*
 * This file is part of the NayzoApiDocBundle.
 *
 * (c) Nayzo <alakhefifi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nayzo\ApiDocBundle\Controller;

use Nayzo\ApiDocBundle\Formatter\RequestAwareSwaggerFormatter;
use Nayzo\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiDocController extends Controller
{
    public function indexAction($view = ApiDoc::DEFAULT_VIEW)
    {
        $extractedDoc = $this->get('nayzo_api_doc.extractor.api_doc_extractor')->all($view);
        $htmlContent  = $this->get('nayzo_api_doc.formatter.html_formatter')->format($extractedDoc);

        return new Response($htmlContent, 200, array('Content-Type' => 'text/html'));
    }

    public function swaggerAction(Request $request, $resource = null)
    {

        $docs = $this->get('nayzo_api_doc.extractor.api_doc_extractor')->all();
        $formatter = new RequestAwareSwaggerFormatter($request, $this->get('nayzo_api_doc.formatter.swagger_formatter'));

        $spec = $formatter->format($docs, $resource ? '/' . $resource : null);

        if ($resource !== null && count($spec['apis']) === 0) {
            throw $this->createNotFoundException(sprintf('Cannot find resource "%s"', $resource));
        }

        return new JsonResponse($spec);
    }
}
