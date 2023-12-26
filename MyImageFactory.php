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
use Fisharebest\Webtrees\Registry;
use Fisharebest\Webtrees\Webtrees;
use Imagick;
use Intervention\Image\Constraint;
use Intervention\Image\Image;

/**
 * Change the default size and position of the watermark image .
 */
class MyImageFactory extends ImageFactory
{ 
    protected const WATERMARK_FILE = '/watermark-module/img/watermark.png';
    /**
     * Create a watermark image, perhaps specific to a media-file.
     *
     * @param int       $width
     * @param int       $height
     * @param MediaFile $media_file
     *
     * @return Image
     */
     /*$width and $height * scale factor, 0.2 = 20% 
     */
    public function createWatermark(int $width, int $height, MediaFile $media_file): Image
    {
        return $this->imageManager()
            ->make(Webtrees::MODULES_DIR . static::WATERMARK_FILE)
            ->resize($width * 0.2, $height * 0.2, static function (Constraint $constraint) {
                $constraint->aspectRatio();
            });
        
    }

    /**
     * Add a watermark to an image.
     *
     * @param Image $image
     * @param Image $watermark
     *
     * @return Image
     */
     /*position keywords: 'center', 'left', 'right', 'top', 'bottom'
          or combinations thereof, 'top-left' etc. 
     */ 
    public function addWatermark(Image $image, Image $watermark): Image
    {
        return $image->insert($watermark, 'bottom-right');
        
    }

    
}
