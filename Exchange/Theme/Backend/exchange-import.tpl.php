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

 $lang = $this->getData('lang');

/**
 * @var \phpOMS\Views\View         $this
 */
echo $this->getData('nav')->render(); 

include __DIR__ . '/../../Interfaces/' . $this->getData('interface')->getInterfacePath() . '/import.tpl.php';
