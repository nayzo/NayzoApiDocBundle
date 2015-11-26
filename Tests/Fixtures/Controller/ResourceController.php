<?php

/*
 * This file is part of the NayzoApiDocBundle.
 *
 * (c) Nayzo <alakhefifi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nayzo\ApiDocBundle\Tests\Fixtures\Controller;
use Nayzo\ApiDocBundle\Annotation\ApiDoc;

class ResourceController
{
    /**
     * @ApiDoc(
     *      resource=true,
     *      views={ "test", "premium", "default" },
     *      resourceDescription="Operations on resource.",
     *      description="List resources.",
     *      output="array<Nayzo\ApiDocBundle\Tests\Fixtures\Model\Test> as tests",
     *      statusCodes={200 = "Returned on success.", 404 = "Returned if resource cannot be found."}
     * )
     */
    public function listResourcesAction()
    {

    }

    /**
     * @ApiDoc(description="Retrieve a resource by ID.")
     */
    public function getResourceAction()
    {

    }

    /**
     * @ApiDoc(description="Delete a resource by ID.")
     */
    public function deleteResourceAction()
    {

    }

    /**
     * @ApiDoc(
     *      description="Create a new resource.",
     *      views={ "default", "premium" },
     *      input={"class" = "Nayzo\ApiDocBundle\Tests\Fixtures\Form\SimpleType", "name" = ""},
     *      output="Nayzo\ApiDocBundle\Tests\Fixtures\Model\JmsNested",
     *      responseMap={
     *          400 = {"class" = "Nayzo\ApiDocBundle\Tests\Fixtures\Form\SimpleType", "form_errors" = true}
     *      }
     * )
     */
    public function createResourceAction()
    {

    }

    /**
     * @ApiDoc(
     *      resource=true,
     *      views={ "default", "premium" },
     *      description="List another resource.",
     *      resourceDescription="Operations on another resource.",
     *      output="array<Nayzo\ApiDocBundle\Tests\Fixtures\Model\JmsTest>"
     * )
     */
    public function listAnotherResourcesAction()
    {

    }

    /**
     * @ApiDoc(description="Retrieve another resource by ID.")
     */
    public function getAnotherResourceAction()
    {

    }

    /**
     * @ApiDoc(description="Update a resource bu ID.")
     */
    public function updateAnotherResourceAction()
    {

    }
}
