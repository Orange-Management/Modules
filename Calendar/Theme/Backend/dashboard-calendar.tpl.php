<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Calendar
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
?>
<div id="calendar-dashboard" class="col-xs-12 col-md-6" draggable="true">
    <?= $this->getData('calendar')->render($this->getData('cal')); ?>
</div>
