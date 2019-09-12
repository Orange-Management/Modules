<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Billing
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Billing\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Mapper class.
 *
 * @package Modules\Billing
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class InvoiceMapper extends DataMapperAbstract
{
    /**
     * Primary field name.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $primaryField = 'billing_invoice_id';

    /**
     * Primary table.
     *
     * @var   string
     * @since 1.0.0
     */
    protected static string $table = 'billing_invoice';
}
