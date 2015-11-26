<?php

namespace Nayzo\ApiDocBundle\Tests\Extractor;

use Nayzo\ApiDocBundle\Extractor\ApiDocExtractor;

class TestExtractor extends ApiDocExtractor
{
    public function __construct()
    {

    }

    public function getNormalization($input)
    {
        return $this->normalizeClassParameter($input);
    }
}
