<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Navigation
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
/**
 * @var \Modules\Navigation\Views\NavigationView $this
 */

if (isset($this->nav[\Modules\Navigation\Models\NavigationType::CONTENT])
    && \phpOMS\Utils\ArrayUtils::inArrayRecursive($this->parent, $this->nav[\Modules\Navigation\Models\NavigationType::CONTENT], 'nav_parent')
) {
    echo '<div class="row"><div class="col-xs-12"><ul class="nav-top" role="navigation">';

    $uriPath = $this->request->getUri()->getPath();

    foreach ($this->nav[\Modules\Navigation\Models\NavigationType::CONTENT] as $key => $parent) {
        foreach ($parent as $link) {
            if ($link['nav_parent'] === $this->parent) {
                $uri = \phpOMS\Uri\UriFactory::build($link['nav_uri']);
                echo '<li'
                    . (\stripos($uri, $uriPath) !== false ? ' class="active"' : '')
                    . '><a href="' . $uri . '">'
                    . $this->getHtml($link['nav_name'], 'Navigation') . '</a>';
            }
        }
    }

    echo '</ul></div></div>';
}
