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


namespace Modules\tests\Address\Admin;

use Modules\Address\Models\CountryMapper;

/**
 * @internal
 */
class AdminTest extends \PHPUnit\Framework\TestCase
{
    protected const MODULE_NAME = 'Address';
    protected const URI_LOAD = '';
    protected const MAPPER_TO_IGNORE = [
        CountryMapper::class,
    ];

    use \Modules\tests\ModuleTestTrait;
}
