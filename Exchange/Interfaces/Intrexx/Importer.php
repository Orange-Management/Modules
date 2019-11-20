<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Interfaces
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Exchange\Interfaces\Intrexx;

use Modules\Exchange\Models\ImporterAbstract;
use phpOMS\Message\RequestAbstract;

/**
 * Intrexx import class
 *
 * @package Modules\Exchange\Models\Interfaces\Intrexx
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class Importer extends ImporterAbstract
{
    /**
     * Import data from request
     *
     * @param RequestAbstract $request Request
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function importFromRequest(RequestAbstract $request) : bool
    {
        return true;
    }
}
