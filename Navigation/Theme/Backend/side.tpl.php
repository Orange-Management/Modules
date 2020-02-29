<?php
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
declare(strict_types=1);

use \Modules\Navigation\Models\LinkType;
use \Modules\Navigation\Models\NavigationType;

/**
 * @var \Modules\Navigation\Views\NavigationView $this
 */
if (isset($this->nav[NavigationType::SIDE])) : ?>
    <ul id="nav-side" class="nav" role="navigation">
        <?php
        $uriPath = $this->request->getUri()->getPath();
        foreach ($this->nav[NavigationType::SIDE][LinkType::CATEGORY] as $key => $parent) : ?>
        <li><input id="nav-<?= $this->printHtml($parent['nav_name']); ?>" type="checkbox">
            <ul>
                <li><label for="nav-<?= $this->printHtml($parent['nav_name']); ?>">
                    <?php if (isset($parent['nav_icon'])) : ?>
                        <i class="<?= $this->printHtml($parent['nav_icon']); ?>"></i>
                    <?php endif; ?>
                    <span><?= $this->getHtml($parent['nav_name'], 'Navigation') ?></span><i class="fa fa-chevron-right expand"></i></label>
                    <?php if (isset($this->nav[NavigationType::SIDE][LinkType::LINK])) :
                        foreach ($this->nav[NavigationType::SIDE][LinkType::LINK] as $key2 => $link) :
                            if ($link['nav_parent'] === $key) :
                                $uri = \phpOMS\Uri\UriFactory::build($link['nav_uri']);
                                $parentUri = \explode('/', $uri);
                                \array_pop($parentUri);
                                $miniParent = \ltrim(\implode('/', $parentUri), '/') . '/';
                                // todo: very simpleminded solution. doesn't work for root path /en/backend etc. e.g. dashboard
                                // this also fails for urls which are not structured like a tree
                            ?>
                                <li<?= (\count($parentUri) > 2 && \stripos($uriPath, $miniParent) !== false) ? ' class="active"' : '' ?>>
                                    <a href="<?= $uri; ?>"><?= $this->getHtml($link['nav_name'], 'Navigation') ?></a>
                            <?php endif;
                        endforeach;
                    endif; ?>
            </ul>
        <?php endforeach; ?>
    </ul>
<?php
endif;
