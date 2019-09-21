<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Exchange
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */

 $lang = $this->getData('lang');

/**
 * @var \phpOMS\Views\View $this
 */
echo $this->getData('nav')->render();

include __DIR__ . '/../../Interfaces/' . $this->getData('interface')->getInterfacePath() . '/import.tpl.php';
