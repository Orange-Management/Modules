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
 * @var \phpOMS\Views\View $this
 */

$newsList = $this->getData('news');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table">
                <caption><?= $this->getText('News') ?></caption>
                <thead>
                <tr>
                    <td>
                    <td><?= $this->getText('Type'); ?>
                    <td class="wf-100"><?= $this->getText('Title'); ?>
                    <td><?= $this->getText('Author'); ?>
                    <td><?= $this->getText('Date'); ?>
                <tbody>
                <?php $count = 0; foreach($newsList as $key => $news) : $count++;
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/news/article?{?}id=' . $news->getId());
                $color = 'darkred';
                if($news->getType() === \Modules\News\Models\NewsType::ARTICLE) { $color = 'green'; }
                elseif($news->getType() === \Modules\News\Models\NewsType::HEADLINE) { $color = 'purple'; }
                elseif($news->getType() === \Modules\News\Models\NewsType::LINK) { $color = 'yellow'; }
                ?>
                <tr>
                    <td data-label=""><a href="<?= $url; ?>"><?= $news->isFeatured() ? '<i class="fa fa-star favorite"></i>' : ''; ?></a>
                    <td data-label="<?= $this->getText('Type'); ?>"><a href="<?= $url; ?>"><span class="tag <?= $color; ?>"><?= $this->getText('TYPE' . $news->getType()); ?></span></a>
                    <td data-label="<?= $this->getText('Title'); ?>"><a href="<?= $url; ?>"><?= $news->getTitle(); ?></a>
                    <td data-label="<?= $this->getText('Author'); ?>"><a href="<?= $url; ?>"><?= $news->getCreatedBy(); ?></a>
                    <td data-label="<?= $this->getText('Date'); ?>"><a href="<?= $url; ?>"><?= $news->getPublish()->format('Y-m-d'); ?></a>
                        <?php endforeach; ?>
                        <?php if($count === 0) : ?>
                <tr><td colspan="5" class="empty"><?= $this->getText('Empty', 0, 0); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>
