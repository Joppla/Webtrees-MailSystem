<?php /** @noinspection PhpIllegalPsrClassPathInspection */

declare(strict_types=1);
namespace EvanG\Modules\MailSystem;

// Module
use Fisharebest\Webtrees\Module\AbstractModule;
use Fisharebest\Webtrees\Module\ModuleCustomInterface;
use Fisharebest\Webtrees\Module\ModuleCustomTrait;
use Fisharebest\Webtrees\View;

// Router
use Aura\Router\RouterContainer;
use Fig\Http\Message\RequestMethodInterface;

use Composer\Autoload\ClassLoader;

/** Sends a mail with recent changes to Webtrees users. */
class MailSystem extends AbstractModule implements ModuleCustomInterface {
    use ModuleCustomTrait;

    public function __construct()
    {
        $loader = new ClassLoader();
        $loader->addPsr4('EvanG\\Modules\\MailSystem\\', __DIR__);
        $loader->register();
    }

    public function boot(): void
    {
        View::registerNamespace($this->name(), $this->resourcesFolder() . 'views/');

        $router = app(RouterContainer::class);
        assert($router instanceof RouterContainer);

        $map = $router->getMap();
        $map->get(RequestHandler::ROUTE_PREFIX, '/' . RequestHandler::ROUTE_PREFIX . '/{action}', new RequestHandler($this))
            ->allows(RequestMethodInterface::METHOD_GET);
    }

    public function title(): string { return 'Mail System'; }
    public function description(): string { return 'Sends a mail with recent changes to Webtrees users.'; }
    public function customModuleAuthorName(): string { return 'EvanG'; }
    public function customModuleVersion(): string { return '1.0.0'; }
    public function customModuleSupportUrl(): string { return 'https://github.com/06Games/Webtrees-MailSystem'; }
    public function resourcesFolder(): string { return __DIR__ . '/resources/'; }
    public function customTranslations(string $language): array
    {
        switch ($language) {
            case 'en-AU':
            case 'en-GB':
            case 'en-US':
            default:
                return ['This email was autogenerated by Webtrees and programmed with ❤ by %s'  => 'This email was autogenerated by Webtrees and programmed with ❤ by %s'];

            case 'fr':
            case 'fr-CA':
                return ['This email was autogenerated by Webtrees and programmed with ❤ by %s'  => 'Cet email a été autogénéré par Webtrees et programmé avec ❤ par %s'];
        }
    }
}
return new MailSystem();
