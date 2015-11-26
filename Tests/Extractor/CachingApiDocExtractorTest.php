<?php

namespace Nayzo\ApiDocBundle\Tests\Extractor;

use Nayzo\ApiDocBundle\Annotation\ApiDoc;
use Nayzo\ApiDocBundle\Extractor\CachingApiDocExtractor;
use Nayzo\ApiDocBundle\Tests\WebTestCase;

class CachingApiDocExtractorTest extends WebTestCase
{
    /**
     * @return array
     */
    public static function viewsWithoutDefaultProvider()
    {
        $data = ApiDocExtractorTest::dataProviderForViews();
        // remove default view data from provider
        array_shift($data);
        return $data;
    }

    /**
     * Test that every view cache is saved in its own cache file
     *
     * @dataProvider viewsWithoutDefaultProvider
     * @param string $view View name
     */
    public function testDifferentCacheFilesAreCreatedForDifferentViews($view)
    {
        $container = $this->getContainer();
        /* @var CachingApiDocExtractor $extractor */
        $extractor = $container->get('nayzo_api_doc.extractor.api_doc_extractor');
        $this->assertInstanceOf('\Nayzo\ApiDocBundle\Extractor\CachingApiDocExtractor', $extractor);

        set_error_handler(array($this, 'handleDeprecation'));
        $defaultData = $extractor->all(ApiDoc::DEFAULT_VIEW);
        $data = $extractor->all($view);
        restore_error_handler();

        $this->assertInternalType(\PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY, $data);
        $this->assertNotSameSize($defaultData, $data);
        $this->assertNotEquals($defaultData, $data);

        $cacheFile = $container->getParameter('kernel.cache_dir').'/api-doc.cache';

        $expectedDefaultViewCacheFile = $cacheFile.'.'.ApiDoc::DEFAULT_VIEW;
        $expectedViewCacheFile = $cacheFile.'.'.$view;

        $this->assertFileExists($expectedDefaultViewCacheFile);
        $this->assertFileExists($expectedViewCacheFile);
        $this->assertFileNotEquals($expectedDefaultViewCacheFile, $expectedViewCacheFile);
    }

    /**
     * @dataProvider \Nayzo\ApiDocBundle\Tests\Extractor\ApiDocExtractorTest::dataProviderForViews
     * @param string $view View name to test
     */
    public function testCachedResultSameAsGenerated($view)
    {
        $container = $this->getContainer();
        /* @var CachingApiDocExtractor $extractor */
        $extractor = $container->get('nayzo_api_doc.extractor.api_doc_extractor');
        $this->assertInstanceOf('\Nayzo\ApiDocBundle\Extractor\CachingApiDocExtractor', $extractor);

        $cacheFile = $container->getParameter('kernel.cache_dir').'/api-doc.cache';

        $expectedViewCacheFile = $cacheFile.'.'.$view;

        $this->assertFileNotExists($expectedViewCacheFile);

        set_error_handler(array($this, 'handleDeprecation'));
        $data = $extractor->all($view);

        $this->assertFileExists($expectedViewCacheFile);

        $cachedData = $extractor->all($view);
        restore_error_handler();

        $this->assertInternalType(\PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY, $data);
        $this->assertInternalType(\PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY, $cachedData);
        $this->assertSameSize($data, $cachedData);
        $this->assertEquals($data, $cachedData);
    }
}
