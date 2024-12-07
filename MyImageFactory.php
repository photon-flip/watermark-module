<?php

/**
 * webtrees: online genealogy
 * Copyright (C) 2023 webtrees development team
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace Fisharebest\Webtrees\Factories;

use Fisharebest\Webtrees\MediaFile;
use Intervention\Image\Interfaces\ImageInterface;

/**
 * Make an image (from another image).
 */
class MyImageFactory extends ImageFactory
{
    protected const string WATERMARK_FILE = '/resources/img/watermark.png';

    /**
     * Create a watermark image, perhaps specific to a media-file.
     */
    public function createWatermark(int $width, int $height, MediaFile $media_file): ImageInterface
    {
        return $this->imageManager()
            ->read(input:  __DIR__  . static::WATERMARK_FILE)
            ->scale(width: $width , height: $height);
    }

    /**
     * Add a watermark to an image.
     */
    public function addWatermark(ImageInterface $image, ImageInterface $watermark): ImageInterface
    {
        return $image->place(element: $watermark, position: 'bottom');
    }
    
}
