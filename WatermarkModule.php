<?php

/**
 * Watermark module.
 */

declare(strict_types=1);

namespace Watermark\Webtrees\Module\WatermarkModule;

include __DIR__ . '/MyImageFactory.php';

use Fisharebest\Localization\Translation;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\Factories\MyImageFactory;
use Fisharebest\Webtrees\Registry;

/**
 * Class WatermarkModule * 
 */
class WatermarkModule extends AbstractModule implements ModuleCustomInterface
{
    use ModuleCustomTrait;
    
    
    /**
     * Bootstrap.  This function is called on *enabled* modules.
     * It is a good place to register routes and views.
     * Note that it is only called on genealogy pages - not on admin pages.
     *
     * @return void
     */
    public function boot(): void
    {
        Registry::ImageFactory(new MyImageFactory());
    }

    /**
     * How should this module be identified in the control panel, etc.?
     *
     * @return string
     */
    public function title(): string
    {
        return I18N::translate('Watermark Module');
    }

    /**
     * A sentence describing what this module does.
     *
     * @return string
     */
    public function description(): string
    {
        return I18N::translate('Changes the size and position of the watermark');
    } 
    
    /**
     * The person or organisation who created this module.
     *
     * @return string
     */
    public function customModuleAuthorName(): string
    {
        return 'MurrayJ';
    }
    
    /**
     * Where to get support for this module.  Perhaps a github repository?
     *
     * @return string
     */
    public function customModuleSupportUrl(): string
    {
        return 'https://fullerbennett.com/tree/fuller-bennett/contact?to=murrayj';
    }
    

}
