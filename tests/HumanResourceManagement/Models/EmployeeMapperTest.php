<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package    tests
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */

namespace Modules\tests\HumanResourceManagement\Models;

use Modules\Admin\Models\Account;
use Modules\Admin\Models\AccountMapper;
use Modules\HumanResourceManagement\Models\Employee;

use Modules\HumanResourceManagement\Models\EmployeeMapper;
use Modules\Organization\Models\Department;
use Modules\Organization\Models\Position;
use Modules\Organization\Models\Unit;

use phpOMS\Account\AccountStatus;
use phpOMS\Account\AccountType;

use phpOMS\Utils\RnG\Name;

/**
 * @internal
 */
class EmployeeMapperTest extends \PHPUnit\Framework\TestCase
{
    public function testCRUD() : void
    {
    }
}
