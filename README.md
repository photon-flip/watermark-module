# webtrees module 2.2 - reposition-webtrees-watermark

[![License: GPL v3](https://img.shields.io/badge/License-GPL%20v3-blue.svg)](http://www.gnu.org/licenses/gpl-3.0)
![webtrees major version](https://img.shields.io/badge/webtrees-v2.1.x-green)


This [webtrees](https://www.webtrees.net/) custom module changes the default size and position of the webtrees watermark image.

## Contents
This Readme contains the following main sections

* [Description](#description)
* [Requirements](#requirements)
* [Installation](#installation)
* [Upgrade](#upgrade)
* [Translation](#translation)
* [Support](#support)
* [License](#license)

<a name="description"></a>
## Description

This custom module changes the default size and position of the watermark image. These can be altered to you needs with simple edits to the MyImageFactory code.
This module was created with the generous help of Greg Roach [fisharebest](https://github.com/fisharebest/webtrees).

<a name="requirements"></a>
## Requirements

This module requires **webtrees** version 2.1 or later.
This module has the same requirements as [webtrees#system-requirements](https://github.com/fisharebest/webtrees#system-requirements).

This module was tested with **webtrees** 2.1.17 version and most available themes.

<a name="installation"></a>
## Installation

This section documents installation instructions for this module.

1. Download the [latest release](https://github.com/photon-flip/reposition-webtrees-watermark/releases).
2. Unzip the package into your `webtrees/modules_v4` directory of your web server.
3. Rename the folder to `reposition-watermark-module`. It's safe to overwrite the respective directory if it already exists.
4. Login to **webtrees** as administrator, go to <span class="pointer">Control Panel/Modules/</span>
   and find the module `Watermark Module`. Check if it has a tick for "Enabled".
5. Finally, click SAVE, to complete the configuration.

<a name="customization"></a>
## Customization

The default instalation contains default webtrees watermar image and a sample photshop PSD template image as a basis for your own personalization.
Simply modify and saveas with the file name 'watermark.png' of type .png
The size and position of the watermark can be changed with simple modifications to code in the 'webtrees/modules_v4reposition-webtrees-watermark/MyWatermarkFactory.php'
On line 50 '->resize($width * 0.2, $height * 0.2' change the values for $width and $height. These are a scale factor ie. .02 represents 20%.
On line 69 'turn $image->insert($watermark, 'bottom-right');' change the position with key words: 'center', 'left', 'right', 'top', 'bottom'
or combinations thereof, 'top-left' etc.

<a name="persistant cache"></a>
## Persistant Cache

The final watermarked images are single combined images and are stores in the webtrees data/cache.
After installing or updating the module or code, images can take some time to be used instead of those previously cached. 
This can be sped up by clearing the data/cache.
Go to: Control panel/Clean up data folder/cache and  click the bin icon.
Some images may also be stored for a time in the Browswer cache and this may also need to be cleared if required.


<a name="upgrade"></a>
## Upgrade

To update simply replace the `reposition-watermark-module`
files with the new ones from the latest release.


<a name="support"></a>
## Support

<span style="font-weight: bold;">Issues: </span>you can report errors raising an issue in this GitHub repository.

<span style="font-weight: bold;">Forum: </span>general webtrees support can be found at the [webtrees forum](http://www.webtrees.net/)

<a name="license"></a>
## License

* Copyright © 2023 Murray J Peterson

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.

* * *

