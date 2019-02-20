<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    tests
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests;

use phpOMS\ApplicationAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\Dispatcher\Dispatcher;
use phpOMS\Message\Http\Request;
use phpOMS\Module\ModuleManager;
use phpOMS\Module\NullModule;
use phpOMS\Router\Router;
use phpOMS\Uri\Http;
use phpOMS\Utils\TestUtils;
use phpOMS\Validation\Base\Json;
use phpOMS\Version\Version;

trait ModuleTestTrait
{
    protected $app = null;

    protected function setUp() : void
    {
        $this->app = new class extends ApplicationAbstract
        {
            protected $appName = 'Api';
        };

        $this->app->dbPool     = $GLOBALS['dbpool'];
        $this->app->router     = new Router();
        $this->app->dispatcher = new Dispatcher($this->app);
    }

    /**
     * @group admin
     * @slowThreshold 5000
     */
    public function testModuleIntegration() : void
    {
        $moduleManager = new ModuleManager($this->app, __DIR__ . '/../../Modules');
        $moduleManager->install(self::MODULE_NAME);

        self::assertTrue($moduleManager->deactivate(self::MODULE_NAME));
        self::assertFalse($moduleManager->isActive(self::MODULE_NAME));

        self::assertTrue($moduleManager->activate(self::MODULE_NAME));
        self::assertTrue($moduleManager->isActive(self::MODULE_NAME));
    }

    /**
     * @group final
     */
    public function testMembers() : void
    {
        $moduleManager      = new ModuleManager($this->app, __DIR__ . '/../../Modules');
        $sampleInfo         = \json_decode(\file_get_contents(__DIR__ . '/info.json'), true);
        $totalBackendRoutes = \file_exists(__DIR__ . '/../../Web/Backend/Routes.php' ) ? include __DIR__ . '/../../Web/Backend/Routes.php' : [];
        $totalApiRoutes     = \file_exists(__DIR__ . '/../../Web/Api/Routes.php' ) ? include __DIR__ . '/../../Web/Api/Routes.php' : [];
        $totalBackendHooks  = \file_exists(__DIR__ . '/../../Web/Backend/Hooks.php' ) ? include __DIR__ . '/../../Web/Backend/Hooks.php' : [];
        $totalApiHooks      = \file_exists(__DIR__ . '/../../Web/Api/Hooks.php' ) ? include __DIR__ . '/../../Web/Api/Hooks.php' : [];
        $infoTemplate       = \json_decode(\file_get_contents(__DIR__ . '/../../phpOMS/Module/infoLayout.json'), true);

        $module = $moduleManager->get(self::MODULE_NAME);

        if (!($module instanceof NullModule)) {
            self::assertEquals(self::MODULE_NAME, $module::MODULE_NAME);
            self::assertEquals(\realpath(__DIR__ . '/../../Modules/' . $module::MODULE_NAME), \realpath($module::MODULE_PATH));
            self::assertGreaterThanOrEqual(0, Version::compare($module::MODULE_VERSION, '1.0.0'));

            // test if navigation db entries match json files
            if (!($moduleManager->get('Navigation') instanceof NullModule)
                && \file_exists($module::MODULE_PATH . '/Admin/Install/Navigation.install.json')
            ) {
                self::assertTrue(
                    $this->navLinksTest(
                        $this->app->dbPool->get(),
                        \json_decode(
                            \file_get_contents($module::MODULE_PATH . '/Admin/Install/Navigation.install.json'),
                            true
                        ),
                        self::MODULE_NAME
                    )
                );
            }

            // test routes
            if (\file_exists($module::MODULE_PATH . '/Admin/Routes/Web/Backend.php')) {
                $moduleRoutes = include $module::MODULE_PATH . '/Admin/Routes/Web/Backend.php';
                self::assertEquals(1, $this->routesTest($moduleRoutes, $totalBackendRoutes), 'Backend route assert failed for '. self::MODULE_NAME);
            }

            // test routes
            if (\file_exists($module::MODULE_PATH . '/Admin/Routes/Web/Api.php')) {
                $moduleRoutes = include $module::MODULE_PATH . '/Admin/Routes/Web/Api.php';
                self::assertEquals(1, $this->routesTest($moduleRoutes, $totalApiRoutes), 'Api route assert failed for '. self::MODULE_NAME);
            }

            // test hooks
            if (\file_exists($module::MODULE_PATH . '/Admin/Hooks/Web/Backend.php')) {
                $moduleHooks = include $module::MODULE_PATH . '/Admin/Hooks/Web/Backend.php';
                self::assertEquals(1, $this->hooksTest($moduleHooks, $totalBackendHooks), 'Backend hook assert failed for '. self::MODULE_NAME);
            }

            // test hooks
            if (\file_exists($module::MODULE_PATH . '/Admin/Hooks/Web/Api.php')) {
                $moduleHooks = include $module::MODULE_PATH . '/Admin/Hooks/Web/Api.php';
                self::assertEquals(1, $this->hooksTest($moduleHooks, $totalApiHooks), 'Api hook assert failed for '. self::MODULE_NAME);
            }

            // validate info.json
            $info = \json_decode(\file_get_contents($module::MODULE_PATH . '/info.json'), true);
            self::assertTrue($this->infoJsonTest($info, $sampleInfo), 'Info assert failed for '. self::MODULE_NAME);
            self::assertTrue(Json::validateTemplate($infoTemplate, $info), 'Invalid template for ' . self::MODULE_NAME);

            // validate dependency installation
            self::assertTrue($this->dependencyTest($info, $moduleManager->getInstalledModules(false)));

            // todo: validate db.json schema

            // todo: validate mapper/model definition

            // todo: validate form validation
        }
    }

    private function navLinksTest($db, array $links, string $module) : bool
    {
        $query = new Builder($db);
        $query->select('nav_id')->from('oms_nav')->where('nav_from', '=', $module);

        $result = $query->execute()->fetchAll(\PDO::FETCH_COLUMN);
        $it     = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($links));

        foreach ($it as $link) {
            if (\is_array($link)
                && !\in_array($link['id'], $result)
            ) {
                return false;
            }
        }

        return true;
    }

    private function dependencyTest(array $info, array $modules) : bool
    {
        foreach ($info['dependencies'] as $module => $version) {
            if (!isset($modules[$module])) {
                return false;
            }
        }

        return true;
    }

    private function routesTest(array $module, array $total) : int
    {
        foreach ($module as $route => $dests) {
            // test route existence after installation
            if (!isset($total[$route])) {
                return -1;
            }

            // test route class
            foreach ($dests as $verb) {
                $parts = \explode(':', $verb['dest']);
                $path  = __DIR__ . '/../../' . \ltrim(\str_replace('\\', '/', $parts[0]), '/') . '.php';
                if (!\file_exists($path)) {
                    return -2;
                }

                // test route method
                $content = \file_get_contents($path);
                if (\stripos($content, 'function ' . $parts[\count($parts) - 1]) === false) {
                    return -3;
                }
            }
        }

        return 1;
    }

    private function hooksTest(array $module, array $total) : int
    {
        foreach ($module as $route => $dests) {
            if (!isset($total[$route])) {
                return -1;
            }

            // test route class
            foreach ($dests['callback'] as $callback) {
                $parts = \explode(':', $callback);
                $path  = __DIR__ . '/../../' . \ltrim(\str_replace('\\', '/', $parts[0]), '/') . '.php';
                if (!\file_exists($path)) {
                    return -2;
                }

                // test route method
                $content = \file_get_contents($path);
                if (\stripos($content, 'function ' . $parts[\count($parts) - 1]) === false) {
                    return -3;
                }
            }
        }

        return 1;
    }

    private function infoJsonTest(array $module, array $sample) : bool
    {
        try {
            if (\gettype($module['name']['id']) === \gettype($sample['name']['id'])
                && \gettype($module['name']['internal']) === \gettype($sample['name']['internal'])
                && \gettype($module['name']['external']) === \gettype($sample['name']['external'])
                && \gettype($module['category']) === \gettype($sample['category'])
                && \gettype($module['version']) === \gettype($sample['version'])
                && \gettype($module['requirements']) === \gettype($sample['requirements'])
                && \gettype($module['creator']) === \gettype($sample['creator'])
                && \gettype($module['creator']['name']) === \gettype($sample['creator']['name'])
                && \gettype($module['description']) === \gettype($sample['description'])
                && \gettype($module['directory']) === \gettype($sample['directory'])
                && \gettype($module['dependencies']) === \gettype($sample['dependencies'])
                && \gettype($module['providing']) === \gettype($sample['providing'])
                && \gettype($module['load']) === \gettype($sample['load'])
            ) {
                return true;
            }
        } catch (\Throwable $e) {
            return false;
        }

        return false;
    }

    public function testRequestLoads() : void
    {
        if (empty(self::URI_LOAD)) {
            return;
        }

        $moduleManager = new ModuleManager($this->app, __DIR__ . '/../../Modules');

        $request = new Request(new Http(self::URI_LOAD));
        $request->createRequestHashs(1);

        $loaded = $moduleManager->getUriLoad($request);

        $found = false;
        foreach ($loaded[4] as $module) {
            if ($module['module_load_file'] === self::MODULE_NAME) {
                $found = true;
                break;
            }
        }

        self::assertTrue($found);
        self::assertGreaterThan(0, \count($moduleManager->getLanguageFiles($request)));
        self::assertTrue(\in_array(self::MODULE_NAME, $moduleManager->getRoutedModules($request)));

        $moduleManager->initRequestModules($request);
        self::assertTrue(isset(TestUtils::getMember($moduleManager, 'running')[self::MODULE_NAME]));
    }
}
