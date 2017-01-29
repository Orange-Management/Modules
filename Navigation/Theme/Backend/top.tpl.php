<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \Modules\Navigation\Views\NavigationView $this
 */
if (isset($this->nav[\Modules\Navigation\Models\NavigationType::TOP])): ?>
    <ul id="t-nav" role="navigation">

        <?php $unread = $this->getData('unread');
        foreach ($this->nav[\Modules\Navigation\Models\NavigationType::TOP] as $key => $parent) :
        foreach ($parent as $link) : ?>
        <li><a href="<?= \phpOMS\Uri\UriFactory::build($link['nav_uri']); ?>">

                <?php if (isset($link['nav_icon'])) : ?>
                    <i class="<?= $link['nav_icon']; ?> infoIcon"><?php if(isset($unread[$link['nav_from']])) : ?><span class="badge"><?= $unread[$link['nav_from']]; ?></span><?php endif; ?></i>
                <?php endif; ?>

                <?= $this->getText($link['nav_name']); ?></a>
            <?php endforeach;
            endforeach; ?>

    </ul>
<?php endif;
