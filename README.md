# Watermark Module for webtrees

This [webtrees](https://www.webtrees.net/) custom module adds a watermark to media images. Administrators can choose one of the included watermark images and select where it appears on the image.

## Requirements

- webtrees 2.2
- The same PHP extensions as webtrees uses for image processing

The module is structured and tested against the webtrees 2.2 image API. Its translation loader also supports the planned webtrees 2.3 translation API; final 2.3 compatibility will be verified when webtrees 2.3 is publicly available.

## Installation

1. Download the latest release.
2. Unzip it into the `modules_v4` directory of your webtrees installation.
3. Sign in to webtrees as an administrator and enable **Watermark Module** in the control panel.
4. Open the module configuration page to choose a watermark image and its position.

## Configuration

The configuration page shows previews of the three included PNG images. Choose exactly one:

- Watermark
- Default webtrees watermark
- Copyright watermark

Choose any of the nine standard positions: top, centre, bottom, left, right, or a corner. To use your own image, replace `resources/img/watermark.png` in the module folder and select **Watermark** in the configuration page.

webtrees caches generated media images. After changing the image or its position, clear the webtrees data-folder cache in the control panel and refresh the browser cache if the previous image is still shown.

## Translation

The module uses the standard webtrees PO/MO translation system. English source strings are in `resources/lang/default.pot`; translations can be added as language-specific PO files and compiled to MO files.

## Support

Please report errors or suggestions in the [GitHub issue tracker](https://github.com/photon-flip/watermark-module/issues).

## License

Copyright © 2024 Murray J Peterson

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
