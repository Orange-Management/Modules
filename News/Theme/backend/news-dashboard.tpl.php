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
 * @var \phpOMS\Views\View $this
 */

$newsList = $this->getData('news');

echo $this->getData('nav')->render(); ?>

<section class="box w-100 floatLeft">
    <table class="table">
        <caption><?= $this->l11n->lang['News']['News'] ?></caption>
        <thead>
        <tr>
            <td>
            <td><?= $this->l11n->lang['News']['Type']; ?>
            <td class="wf-100"><?= $this->l11n->lang['News']['Title']; ?>
            <td><?= $this->l11n->lang['News']['Author']; ?>
            <td><?= $this->l11n->lang['News']['Date']; ?>
                <tbody>
                <?php $count = 0; foreach($newsList as $key => $news) : $count++;
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/news/article?id=' . $news->getId());
                $color = 'darkred';
                if($news->getType() === \Modules\News\Models\NewsType::ARTICLE) { $color = 'green'; }
                elseif($news->getType() === \Modules\News\Models\NewsType::HEADLINE) { $color = 'purple'; }
                elseif($news->getType() === \Modules\News\Models\NewsType::LINK) { $color = 'yellow'; }
                ?>
                    <tr>
                        <td><a href="<?= $url; ?>"><?= $news->isFeatured() ? '<i class="fa fa-star favorite"></i>' : ''; ?></a>
                        <td><a href="<?= $url; ?>"><span class="tag <?= $color; ?>"><?= $this->l11n->lang['News']['TYPE' . $news->getType()]; ?></span></a>
                        <td><a href="<?= $url; ?>"><?= $news->getTitle(); ?></a>
                        <td><a href="<?= $url; ?>"><?= $news->getCreatedBy(); ?></a>
                        <td><a href="<?= $url; ?>"><?= $news->getPublish()->format('Y-m-d'); ?></a>
                <?php endforeach; ?>
                <?php if($count === 0) : ?>
        <tr><td colspan="3" class="empty"><?= $this->l11n->lang[0]['Empty']; ?>
                <?php endif; ?>
    </table>
</section>
