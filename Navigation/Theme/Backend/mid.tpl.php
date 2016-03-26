<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \Modules\Navigation\Views\NavigationView $this
 */
if (isset($this->nav[\Modules\Navigation\Models\NavigationType::CONTENT])) {
    echo '<ul class="nav-top" role="navigation">';

    foreach ($this->nav[\Modules\Navigation\Models\NavigationType::CONTENT] as $key => $parent) {
        foreach ($parent as $link) {
            if ($link['nav_parent'] == $this->parent) {
                echo '<li><a href="' . \phpOMS\Uri\UriFactory::build($link['nav_uri']) . '">'
                     . $this->l11n->lang['Navigation'][$link['nav_name']] . '</a>';
            }
        }
    }

    echo '</ul>';
}
