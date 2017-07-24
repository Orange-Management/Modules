<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \Modules\Navigation\Views\NavigationView $this
 */
if (isset($this->nav[\Modules\Navigation\Models\NavigationType::SIDE])) : ?>
    <ul id="nav-side" class="nav" role="navigation">
        <?php foreach ($this->nav[\Modules\Navigation\Models\NavigationType::SIDE][\Modules\Navigation\Models\LinkType::CATEGORY] as $key => $parent) : ?>
        <li><input id="nav-<?= htmlspecialchars($parent['nav_name'], ENT_COMPAT, 'utf-8'); ?>" type="checkbox">
            <ul>
                <li>
                    <?php if (isset($parent['nav_icon'])) : ?>
                        <span class="centerText" style="width: 20px; display: inline-block;"><i class="<?= htmlspecialchars($parent['nav_icon'], ENT_COMPAT, 'utf-8'); ?>"></i></span>
                    <?php endif; ?>
                    <?= $this->getHtml($parent['nav_name']) ?><label for="nav-<?= htmlspecialchars($parent['nav_name'], ENT_COMPAT, 'utf-8'); ?>"><i class="fa fa-chevron-down min"></i>
                    <i class="fa fa-chevron-up max"></i></label>
                    <?php foreach ($this->nav[\Modules\Navigation\Models\NavigationType::SIDE][\Modules\Navigation\Models\LinkType::LINK] as $key2 => $link) :
                    if ($link['nav_parent'] === $parent['nav_id']) : ?>
                <li>
                    <a href="<?= \phpOMS\Uri\UriFactory::build($link['nav_uri']); ?>"><?= $this->getHtml($link['nav_name']) ?></a>
                    <?php endif;
                    endforeach; ?>
            </ul>
            <?php endforeach; ?>
    </ul>
<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */ endif;
