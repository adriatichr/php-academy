<?php

namespace Tests\AppBundle\View;

use AppBundle\View\ImageService;
use PHPUnit\Framework\TestCase;

class ImageServiceTest extends TestCase
{
    public function setUp()
    {
        $this->imageService = new TestingImageService('path/to/main/images/');
    }

    /**
     * @testWith [1]
     *           [2]
     */
    public function shouldUseKernelRootDirToCreateImagePath($accommodationId)
    {
        $this->assertEquals('path/to/main/images/apartman' . $accommodationId . '.jpg',
            $this->imageService->getAccommodationMainImagePath($accommodationId));
    }

    /** @test */
    public function shouldReturnPlaceholderImagePathIfImageNotFound()
    {
        $this->imageService->noImageOnDisk();
        $this->assertEquals('path/to/main/images/no-image.jpg',
            $this->imageService->getAccommodationMainImagePath(1));
    }
}


class TestingImageService extends ImageService
{
    private $imagesExistOnDisk = true;

    public function noImageOnDisk()
    {
        $this->imagesExistOnDisk = false;
    }

    protected function fileExists(string $path) : bool
    {
        return $this->imagesExistOnDisk;
    }
}
