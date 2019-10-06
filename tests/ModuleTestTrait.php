<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);


namespace Modules\tests;

use phpOMS\ApplicationAbstract;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Schema\Builder as SchemaBuilder;
use phpOMS\Dispatcher\Dispatcher;
use phpOMS\Message\Http\Request;
use phpOMS\Module\ModuleManager;
use phpOMS\Module\NullModule;
use phpOMS\Router\Router;
use phpOMS\Uri\Http;
use phpOMS\Utils\ArrayUtils;
use phpOMS\Validation\Base\Json;
use phpOMS\Version\Version;

trait ModuleTestTrait
{
    protected $app = null;

    protected function setUp() : void
    {
        $this->app = new class() extends ApplicationAbstract
        {
            protected string $appName = 'Api';
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

    public function testMembers() : void
    {
        $moduleManager = new ModuleManager($this->app, __DIR__ . '/../../Modules');
        $module        = $moduleManager->get(self::MODULE_NAME);

        if (!($module instanceof NullModule)) {
            self::assertEquals(self::MODULE_NAME, self::MODULE_NAME);
            self::assertEquals(\realpath(__DIR__ . '/../../Modules/' . self::MODULE_NAME), \realpath($module::MODULE_PATH));
            self::assertGreaterThanOrEqual(0, Version::compare($module::MODULE_VERSION, '1.0.0'));
        }
    }

    public function testValidMapper() : void
    {
        $mappers = \glob(__DIR__ . '/../../Modules/' . self::MODULE_NAME . '/Models/*Mapper.php');

        foreach ($mappers as $mapper) {
            $class           = $this->getMapperFromPath($mapper);
            $classReflection = new \ReflectionClass($class);
            $columns         = $classReflection->getDefaultProperties()['columns'];

            foreach ($columns as $cName => $column) {
                self::assertTrue(\in_array($column['type'], ['int', 'string', 'DateTime', 'Json', 'Serializable', 'bool', 'float']), 'Mapper "' . $class . '" column "' . $cName . '" has invalid type');
                self::assertEquals($cName, $column['name'] ?? false);
            }
        }
    }

    private function getMapperFromPath(string $mapper) : string
    {
        $name = \substr($mapper, \strlen(__DIR__ . '/../../Modules/' . self::MODULE_NAME . '/Models/'), -4);

        return '\\Modules\\' . self::MODULE_NAME . '\\Models\\' . $name;
    }

    public function testMapperAgainstModel() : void
    {
        $mappers = \glob(__DIR__ . '/../../Modules/' . self::MODULE_NAME . '/Models/*Mapper.php');

        foreach ($mappers as $mapper) {
            $class            = $this->getMapperFromPath($mapper);
            $mapperReflection = new \ReflectionClass($class);
            $columns          = $mapperReflection->getDefaultProperties()['columns'];

            if ($class === '\Modules\Admin\Models\ModuleMapper') {
                continue;
            }

            if (!Autoloader::exists(\substr($class, 0, -6))) {
                continue;
            }

            $classReflection   = new \ReflectionClass(\substr($class, 0, -6));
            $defaultProperties = $classReflection->getDefaultProperties();

            foreach ($columns as $cName => $column) {
                $isArray = false;
                // testing existence of member variable in model
                if (\stripos($column['internal'], '/') !== false) {
                    $column['internal'] = \explode('/', $column['internal'])[0];
                    $isArray = true;
                }

                self::assertTrue(
                    $classReflection->hasProperty($column['internal']),
                    'Mapper "' . $class . '" column "' . $cName . '" has missing/invalid internal/member'
                );

                // testing correct mapper/model variable type definition
                $property = $defaultProperties[$column['internal']] ?? null;
                self::assertTrue(
                    $property === null /* @todo: change in the future. not every column value is alowed to be null. a flag needs to be implemented in the mapper column definitions e.g. null = true */
                    || (\is_string($property) && $column['type'] === 'string')
                    || (\is_int($property) && $column['type'] === 'int')
                    || (\is_array($property) && ($column['type'] === 'Json' || $column['type'] === 'Serializable' || $isArray))
                    || (\is_bool($property) && $column['type'] === 'bool')
                    || (\is_float($property) && $column['type'] === 'float')
                    || ($property instanceof \DateTime && $column['type'] === 'DateTime'),
                    'Mapper "' . $class . '" column "' . $cName . '" has invalid type compared to model definition'
                );
            }

            // test correct hasMany model variable type
            $rel = $mapperReflection->getDefaultProperties()['hasMany'];
            foreach ($rel as $pName => $def) {
                self::assertTrue(
                    isset($defaultProperties[$pName]),
                    'Mapper "' . $class . '" property "' . $pName . '" doesn\'t exist in model'
                );

                $property = $defaultProperties[$pName];
                self::assertIsArray($property,
                    'Mapper "' . $class . '" column "' . $cName . '" has invalid type compared to model definition'
                );
            }
        }
    }

    public function testValidDbSchema() : void
    {
        $schemaPath = __DIR__ . '/../../Modules/' . self::MODULE_NAME . '/Admin/Install/db.json';

        if (\file_exists($schemaPath)) {
            $db = \json_decode(\file_get_contents($schemaPath), true);

            foreach ($db as $name => $table) {
                self::assertEquals($name, $table['name'] ?? false);

                foreach ($table['fields'] as $cName => $column) {
                    self::assertEquals($cName, $column['name'] ?? false);
                    self::assertTrue(
                        \stripos($column['type'] ?? '', 'TINYINT') === 0
                        || \stripos($column['type'] ?? '', 'SMALLINT') === 0
                        || \stripos($column['type'] ?? '', 'INT') === 0
                        || \stripos($column['type'] ?? '', 'BIGINT') === 0
                        || \stripos($column['type'] ?? '', 'VARCHAR') === 0
                        || \stripos($column['type'] ?? '', 'VARBINARY') === 0
                        || \stripos($column['type'] ?? '', 'TEXT') === 0
                        || \stripos($column['type'] ?? '', 'DATETIME') === 0
                        || \stripos($column['type'] ?? '', 'DECIMAL') === 0,
                        'Schema "' . $schemaPath . '" type "' . ($column['type'] ?? '') . '" is a missing/invalid type'
                    );
                }
            }

            $dbTemplate = \json_decode(\file_get_contents(__DIR__ . '/../../phpOMS/DataStorage/Database/tableDefinition.json'), true);
            self::assertTrue(Json::validateTemplate($dbTemplate, $db), 'Invalid db template for ' . self::MODULE_NAME);
        }
    }

    public function testDbSchemaAgainstDb() : void
    {
        $builder = new SchemaBuilder($this->app->dbPool->get());
        $tables  = $builder->prefix($this->app->dbPool->get()->prefix)->selectTables()->execute()->fetchAll(\PDO::FETCH_COLUMN);

        $schemaPath = __DIR__ . '/../../Modules/' . self::MODULE_NAME . '/Admin/Install/db.json';

        if (\file_exists($schemaPath)) {
            $db = \json_decode(\file_get_contents($schemaPath), true);

            foreach ($db as $name => $table) {
                self::assertContains($this->app->dbPool->get()->prefix . $name, $tables);

                $field  = new SchemaBuilder($this->app->dbPool->get());
                $fields = $field->prefix($this->app->dbPool->get()->prefix)->selectFields($name)->execute()->fetchAll();

                foreach ($table['fields'] as $cName => $column) {
                    self::assertTrue(
                        ArrayUtils::inArrayRecursive($cName, $fields),
                        'Couldn\'t find "' . $cName . '" in "' . $name . '"'
                    );
                }
            }
        }
    }

    public function testMapperAgainstDbSchema() : void
    {
        $schemaPath = __DIR__ . '/../../Modules/' . self::MODULE_NAME . '/Admin/Install/db.json';
        $mappers    = \glob(__DIR__ . '/../../Modules/' . self::MODULE_NAME . '/Models/*Mapper.php');

        if (\file_exists($schemaPath)) {
            $db = \json_decode(\file_get_contents($schemaPath), true);

            foreach ($mappers as $mapper) {
                $class = $this->getMapperFromPath($mapper);

                if (\defined('self::MAPPER_TO_IGNORE') && \in_array(\ltrim($class, '\\'), self::MAPPER_TO_IGNORE)) {
                    continue;
                }

                $mapperReflection = new \ReflectionClass($class);
                $table            = $mapperReflection->getDefaultProperties()['table'];
                $columns          = $mapperReflection->getDefaultProperties()['columns'];

                if ($class === '\Modules\Admin\Models\ModuleMapper') {
                    continue;
                }

                foreach ($columns as $cName => $column) {
                    // testing existence of field name in schema
                    self::assertTrue(
                        isset($db[$table]['fields'][$cName]),
                        'Mapper "' . $class . '" column "' . $cName . '" doesn\'t match schema'
                    );

                    // testing schema/mapper same column data type
                    self::assertTrue(
                        ($column['type'] === 'string'
                            && (\stripos($db[$table]['fields'][$cName]['type'], 'VARCHAR') === 0
                                || \stripos($db[$table]['fields'][$cName]['type'], 'VARBINARY') === 0
                                || \stripos($db[$table]['fields'][$cName]['type'], 'TEXT') === 0))
                        || ($column['type'] === 'int'
                            && (\stripos($db[$table]['fields'][$cName]['type'], 'TINYINT') === 0
                                || \stripos($db[$table]['fields'][$cName]['type'], 'SMALLINT') === 0
                                || \stripos($db[$table]['fields'][$cName]['type'], 'INT') === 0
                                || \stripos($db[$table]['fields'][$cName]['type'], 'BIGINT') === 0))
                        || ($column['type'] === 'Json'
                            && (\stripos($db[$table]['fields'][$cName]['type'], 'VARCHAR') === 0
                                || \stripos($db[$table]['fields'][$cName]['type'], 'TEXT') === 0))
                        || ($column['type'] === 'Serializable')
                        || ($column['type'] === 'bool' && \stripos($db[$table]['fields'][$cName]['type'], 'TINYINT') === 0)
                        || ($column['type'] === 'float' && \stripos($db[$table]['fields'][$cName]['type'], 'DECIMAL') === 0)
                        || ($column['type'] === 'DateTime' && \stripos($db[$table]['fields'][$cName]['type'], 'DATETIME') === 0),
                        'Schema "' . $schemaPath . '" type "' . ($column['type'] ?? '') . '" is incompatible with mapper "' . $class . '" definition "' . $db[$table]['fields'][$cName]['type'] . '" for field "' . $cName . '"'
                    );
                }

                // testing schema/mapper same primary key definition
                $primary = $mapperReflection->getDefaultProperties()['primaryField'];
                self::assertTrue(
                    $db[$table]['fields'][$primary]['primary'] ?? false,
                    'Field "' . $primary . '" from mapper "' . $class . '" is not defined as primary key in table "' . $table . '"'
                );
            }
        }
    }

    public function testJson() : void
    {
        $moduleManager = new ModuleManager($this->app, __DIR__ . '/../../Modules');
        $sampleInfo    = \json_decode(\file_get_contents(__DIR__ . '/info.json'), true);
        $infoTemplate  = \json_decode(\file_get_contents(__DIR__ . '/../../phpOMS/Module/infoLayout.json'), true);

        $module = $moduleManager->get(self::MODULE_NAME);

        if (!($module instanceof NullModule)) {
            // validate info.json
            $info = \json_decode(\file_get_contents($module::MODULE_PATH . '/info.json'), true);
            self::assertTrue($this->infoJsonTest($info, $sampleInfo), 'Info assert failed for '. self::MODULE_NAME);
            self::assertTrue(Json::validateTemplate($infoTemplate, $info), 'Invalid info template for ' . self::MODULE_NAME);
        }
    }

    public function testDependency() : void
    {
        $moduleManager = new ModuleManager($this->app, __DIR__ . '/../../Modules');
        $module        = $moduleManager->get(self::MODULE_NAME);

        if (!($module instanceof NullModule)) {
            // validate dependency installation
            $info = \json_decode(\file_get_contents($module::MODULE_PATH . '/info.json'), true);
            self::assertTrue($this->dependencyTest($info, $moduleManager->getInstalledModules(false)));
        }
    }

    public function testRoutes() : void
    {
        $moduleManager      = new ModuleManager($this->app, __DIR__ . '/../../Modules');
        $totalBackendRoutes = \file_exists(__DIR__ . '/../../Web/Backend/Routes.php') ? include __DIR__ . '/../../Web/Backend/Routes.php' : [];
        $totalApiRoutes     = \file_exists(__DIR__ . '/../../Web/Api/Routes.php') ? include __DIR__ . '/../../Web/Api/Routes.php' : [];

        $module = $moduleManager->get(self::MODULE_NAME);

        if (!($module instanceof NullModule)) {
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
        }
    }

    public function testHooks() : void
    {
        $moduleManager     = new ModuleManager($this->app, __DIR__ . '/../../Modules');
        $totalBackendHooks = \file_exists(__DIR__ . '/../../Web/Backend/Hooks.php') ? include __DIR__ . '/../../Web/Backend/Hooks.php' : [];
        $totalApiHooks     = \file_exists(__DIR__ . '/../../Web/Api/Hooks.php') ? include __DIR__ . '/../../Web/Api/Hooks.php' : [];

        $module = $moduleManager->get(self::MODULE_NAME);

        if (!($module instanceof NullModule)) {
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
        }
    }

    /**
     * @group final
     */
    public function testNavigation() : void
    {
        $moduleManager = new ModuleManager($this->app, __DIR__ . '/../../Modules');
        $module        = $moduleManager->get(self::MODULE_NAME);

        if (!($module instanceof NullModule)) {
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
        if (!\defined('self::URI_LOAD') || empty(self::URI_LOAD)) {
            return;
        }

        $moduleManager = new ModuleManager($this->app, __DIR__ . '/../../Modules');

        $request = new Request(new Http(self::URI_LOAD));
        $request->createRequestHashs(2);

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
        self::assertTrue($moduleManager->isRunning(self::MODULE_NAME));
    }
}
