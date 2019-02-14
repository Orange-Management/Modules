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
/**
 * @var \phpOMS\Views\View $this
 */

echo $this->getData('nav')->render();
var_dump(\phpOMS\Utils\StringUtils::diffline($this->getData('audit')->getOld() ?? '', $this->getData('audit')->getNew() ?? ''));
?>
