<?php

declare(strict_types=1);

namespace Watermark\Webtrees\Module\WatermarkModule;

require __DIR__ . '/MyImageFactory.php';

use Fisharebest\Webtrees\FlashMessages;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleConfigInterface;
use Fisharebest\Webtrees\Module\ModuleConfigTrait;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\Registry;
use Fisharebest\Webtrees\Services\PhpService;
use Fisharebest\Webtrees\Validator;
use Fisharebest\Webtrees\View;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use function array_key_exists;
use function array_keys;
use function explode;
use function fclose;
use function fopen;
use function is_file;
use function str_ends_with;

/** Configure the watermark used by webtrees media images. */
class WatermarkModule extends AbstractModule implements ModuleConfigInterface, ModuleCustomInterface
{
    use ModuleConfigTrait;
    use ModuleCustomTrait;

    public const CUSTOM_VERSION = '2.2.5';

    /** @var array<string,string> */
    private const WATERMARKS = [
        'watermark.png' => 'Watermark',
        'default-watermark.png' => 'Default webtrees watermark',
        'copyright.png' => 'Copyright watermark',
    ];

    /** @var array<string,string> */
    private const POSITIONS = [
        'top-left' => 'Top left',
        'top' => 'Top',
        'top-right' => 'Top right',
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
        'bottom-left' => 'Bottom left',
        'bottom' => 'Bottom',
        'bottom-right' => 'Bottom right',
    ];

    public function title(): string
    {
        return I18N::translate('Watermark Module');
    }

    public function description(): string
    {
        return I18N::translate('Choose the watermark image and its position on media images.');
    }

    public function customModuleAuthorName(): string
    {
        return 'Murray J Peterson';
    }

    public function customModuleVersion(): string
    {
        return self::CUSTOM_VERSION;
    }

    public function customModuleSupportUrl(): string
    {
        return 'https://github.com/photon-flip/watermark-module/issues';
    }

    public function resourcesFolder(): string
    {
        return __DIR__ . '/resources/';
    }

    /** @return array<string,string> */
    public function customTranslations(string $language): array
    {
        $baseLanguage = explode('-', $language)[0];
        $languageFiles = $language === $baseLanguage ? [$language] : [$language, $baseLanguage];

        foreach ($languageFiles as $languageFile) {
            foreach (['.mo', '.po'] as $extension) {
                $file = $this->resourcesFolder() . 'lang/' . $languageFile . $extension;
                if (!is_file($file)) {
                    continue;
                }

                if (class_exists(\Fisharebest\Webtrees\I18N\Translation::class)) {
                    $stream = fopen($file, 'rb');
                    if ($stream === false) {
                        continue;
                    }

                    try {
                        $translation = $extension === '.mo'
                            ? \Fisharebest\Webtrees\I18N\Translation::fromMoStream($stream)
                            : \Fisharebest\Webtrees\I18N\Translation::fromPoStream($stream);

                        return $translation->toArray();
                    } finally {
                        fclose($stream);
                    }
                }

                if (class_exists(\Fisharebest\Localization\Translation::class)) {
                    return (new \Fisharebest\Localization\Translation($file))->asArray();
                }
            }
        }

        return [];
    }

    public function boot(): void
    {
        Registry::ImageFactory(new MyImageFactory(new PhpService(), $this->watermarkFile(), $this->watermarkPosition()));
        View::registerNamespace($this->name(), $this->resourcesFolder() . 'views/');
    }

    public function getAdminAction(ServerRequestInterface $request): ResponseInterface
    {
        $this->layout = 'layouts/administration';
        View::registerNamespace($this->name(), $this->resourcesFolder() . 'views/');
        $watermarkPreviews = [];
        foreach (array_keys(self::WATERMARKS) as $filename) {
            $watermarkPreviews[$filename] = $this->assetUrl('img/' . $filename);
        }

        return $this->viewResponse($this->name() . '::settings', [
            'title' => $this->title(),
            'description' => $this->description(),
            'watermarks' => self::WATERMARKS,
            'watermark_previews' => $watermarkPreviews,
            'positions' => self::POSITIONS,
            'selected_watermark' => $this->watermarkFile(),
            'selected_position' => $this->watermarkPosition(),
        ]);
    }

    public function postAdminAction(ServerRequestInterface $request): ResponseInterface
    {
        $watermark = Validator::parsedBody($request)->string('watermark');
        $position = Validator::parsedBody($request)->string('position');

        if (!array_key_exists($watermark, self::WATERMARKS) || !array_key_exists($position, self::POSITIONS)) {
            FlashMessages::addMessage(I18N::translate('The selected watermark settings are invalid.'), 'danger');
        } else {
            $this->setPreference('watermark', $watermark);
            $this->setPreference('position', $position);
            FlashMessages::addMessage(I18N::translate('The preferences for the module “%s” have been updated.', $this->title()), 'success');
        }

        return redirect($this->getConfigLink());
    }

    private function watermarkFile(): string
    {
        $watermark = $this->getPreference('watermark', 'watermark.png');

        return array_key_exists($watermark, self::WATERMARKS) ? $watermark : 'watermark.png';
    }

    private function watermarkPosition(): string
    {
        $position = $this->getPreference('position', 'bottom');

        return array_key_exists($position, self::POSITIONS) ? $position : 'bottom';
    }
}
