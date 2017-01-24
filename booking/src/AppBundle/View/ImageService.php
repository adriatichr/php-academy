<?php

namespace AppBundle\View;

class ImageService
{
    private $mainImagesDir;

    public function __construct(string $mainImagesDir)
    {
        $this->mainImagesDir = $mainImagesDir;
    }

    /**
     * Ako slika ne postoji, servira se no-image.jpg slika.
     *
     * @param int $accommodationId
     * @return string putanja do slike
     */
    public function getAccommodationMainImagePath(int $accommodationId) : string
    {
        $path = sprintf('%sapartman%s.jpg', $this->mainImagesDir,
            $accommodationId);

        if($this->fileExists($path))
            return $path;

        return sprintf('%sno-image.jpg', $this->mainImagesDir);
    }

    protected function fileExists(string $path) : bool
    {
        return file_exists($path);
    }
}
