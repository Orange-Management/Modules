<?php declare(strict_types=1);
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

use Modules\Navigation\Models\NavigationType;

/**
 * @var \Modules\Navigation\Views\NavigationView $this
 */
if (isset($this->nav[NavigationType::TOP])): ?>
    <ul id="t-nav" role="navigation">
        <?php $unread = $this->getData('unread');
        foreach ($this->nav[NavigationType::TOP] as $key => $parent) :
        foreach ($parent as $link) : ?>
        <li><a href="<?= \phpOMS\Uri\UriFactory::build($link['nav_uri']); ?>">

                <?php if (isset($link['nav_icon'])) : ?>
                    <i class="<?= $this->printHtml($link['nav_icon']); ?> infoIcon"><?php if (isset($unread[$link['nav_from']]) && $unread[$link['nav_from']] > 0) : ?><span class="badge"><?= $this->printHtml($unread[$link['nav_from']]); ?></span><?php endif; ?></i>
                <?php endif; ?>

                <span class="link"><?= $this->getHtml($link['nav_name'], 'Navigation') ?><span></a>
            <?php endforeach;
            endforeach; ?>
    </ul>
<?php endif;
