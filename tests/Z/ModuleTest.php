<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

namespace Modules\tests\Z;

use phpOMS\ApplicationAbstract;
use phpOMS\DataStorage\Database\DatabasePool;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\Dispatcher\Dispatcher;
use phpOMS\Module\ModuleFactory;
use phpOMS\Module\ModuleManager;
use phpOMS\Module\NullModule;
use phpOMS\Router\Router;
use phpOMS\Version\Version;

class ModuleTest extends \PHPUnit\Framework\TestCase
{
    protected $app = null;

    protected function setUp()
    {
        $this->app = new class extends ApplicationAbstract
        {
        };

        $this->app->dbPool     = $GLOBALS['dbpool'];
        $this->app->router     = new Router();
        $this->app->dispatcher = new Dispatcher($this->app);
    }

    /**
     * @group final
     */
    public function testMembers()
    {
        $moduleManager = new ModuleManager($this->app, __DIR__ . '/../../../Modules');
        $allModules    = $moduleManager->getInstalledModules(false);
        $sampleInfo    = json_decode(file_get_contents(__DIR__ . '/info.json'), true); 
        $totalRoutes   = include __DIR__ . '/../../../Web/Backend/Routes.php';

        foreach ($allModules as $name => $module) {
            $module = $moduleManager->get($name);

            if (!($module instanceof NullModule)) {
                self::assertEquals($name, $module::MODULE_NAME);
                self::assertEquals(realpath(__DIR__ . '/../../../Modules/' . $module::MODULE_NAME), $module::MODULE_PATH);
                $version = Version::compare($module::MODULE_VERSION, '1.0.0');
                self::assertGreaterThanOrEqual(0, $version);

                if (isset($allModules['Navigation']) 
                    && file_exists($module::MODULE_PATH . '/Admin/Install/Navigation.install.json')
                ) {
                    self::assertTrue(
                        $this->navLinksTest(
                            $this->app->dbPool->get(), 
                            json_decode(
                                file_get_contents($module::MODULE_PATH . '/Admin/Install/Navigation.install.json'),
                                true
                            ),
                            $name
                        )
                    );
                }

                if (file_exists($module::MODULE_PATH . '/Admin/Routes/Web/Backend.php')) {
                    $moduleRoutes = include $module::MODULE_PATH . '/Admin/Routes/Web/Backend.php';
                    self::assertTrue($this->routesTest($moduleRoutes, $totalRoutes), 'Route assert failed for '. $name);
                }

                $info = json_decode(file_get_contents($module::MODULE_PATH . '/info.json'), true); 
                self::assertTrue($this->infoJsonTest($info, $sampleInfo), 'Info assert failed for '. $name);

                self::assertTrue($this->dependencyTest($info, $allModules));
            }
        }
    }

    private function navLinksTest($db, array $links, string $module) : bool
    {
        $query = new Builder($db);
        $query->select('nav_id')->from('oms_nav')->where('nav_from', '=', $module);

        $result = $query->execute()->fetchAll(\PDO::FETCH_COLUMN);
        $it     = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($links));

        foreach ($it as $link) {
            if (is_array($link)
                && !in_array($link['id'], $result)
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

    private function routesTest(array $module, array $total) : bool
    {
        foreach ($module as $route => $dests) {
            if (!isset($total[$route])) {
                return false;
            }

            // todo: check dest path currently only route is checked
        }

        return true;
    }

    private function infoJsonTest(array $module, array $sample) : bool
    {
        try {
            if (gettype($module['name']['id']) === gettype($sample['name']['id'])
                && gettype($module['name']['internal']) === gettype($sample['name']['internal'])
                && gettype($module['name']['external']) === gettype($sample['name']['external'])
                && gettype($module['category']) === gettype($sample['category'])
                && gettype($module['version']) === gettype($sample['version'])
                && gettype($module['requirements']) === gettype($sample['requirements'])
                && gettype($module['creator']) === gettype($sample['creator'])
                && gettype($module['creator']['name']) === gettype($sample['creator']['name'])
                && gettype($module['description']) === gettype($sample['description'])
                && gettype($module['directory']) === gettype($sample['directory'])
                && gettype($module['dependencies']) === gettype($sample['dependencies'])
                && gettype($module['providing']) === gettype($sample['providing'])
                && gettype($module['load']) === gettype($sample['load'])
            ) {
                return true;
            }
        } catch (\Throwable $e) {
            return false;
        }

        return false;
    }
}
