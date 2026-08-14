<?php

declare(strict_types=1);

namespace Watermark\Webtrees\Module\WatermarkModule;

use Fisharebest\Webtrees\Factories\ImageFactory;
use Fisharebest\Webtrees\MediaFile;
use Intervention\Image\Interfaces\ImageInterface;

/** Make watermarked images using the module configuration. */
class MyImageFactory extends ImageFactory
{
    public function __construct(
        \Fisharebest\Webtrees\Services\PhpService $phpService,
        private readonly string $watermarkFile,
        private readonly string $watermarkPosition,
    ) {
        parent::__construct($phpService);
    }

    public function createWatermark(int $width, int $height, MediaFile $mediaFile): ImageInterface
    {
        return $this->imageManager()
            ->read(input: __DIR__ . '/resources/img/' . $this->watermarkFile)
            ->scale(width: $width, height: $height);
    }

    public function addWatermark(ImageInterface $image, ImageInterface $watermark): ImageInterface
    {
        return $image->place(element: $watermark, position: $this->watermarkPosition);
    }
}
