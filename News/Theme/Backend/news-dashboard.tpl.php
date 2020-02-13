<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\News
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

use Modules\News\Models\NewsType;

/**
 * @var \phpOMS\Views\View                 $this
 * @var \Modules\News\Models\NewsArticle[] $newsList
 */
$newsList = $this->getData('news');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table id="newsList" class="default">
                <caption><?= $this->getHtml('News'); ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                <tr>
                    <td>
                    <td><?= $this->getHtml('Type') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                    <td class="wf-100"><?= $this->getHtml('Title') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                    <td><?= $this->getHtml('Author') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                    <td><?= $this->getHtml('Date') ?><i class="sort-asc fa fa-chevron-up"></i><i class="sort-desc fa fa-chevron-down"></i>
                <tbody>
                <?php $count = 0; foreach ($newsList as $key => $news) : ++$count;
                $url = \phpOMS\Uri\UriFactory::build('{/prefix}news/article?{?}&id=' . $news->getId());
                $color = 'darkred';
                if ($news->getType() === NewsType::ARTICLE) { $color = 'green'; }
                elseif ($news->getType() === NewsType::HEADLINE) { $color = 'purple'; }
                elseif ($news->getType() === NewsType::LINK) { $color = 'yellow'; }
                ?>
                <tr data-href="<?= $url; ?>">
                    <td><a href="<?= $url; ?>"><?= $news->isFeatured() ? '<i class="fa fa-star favorite"></i>' : ''; ?></a>
                    <td data-label="<?= $this->getHtml('Type') ?>"><a href="<?= $url; ?>"><span class="tag <?= $this->printHtml($color); ?>"><?= $this->getHtml('TYPE' . $news->getType()) ?></span></a>
                    <td data-label="<?= $this->getHtml('Title') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($news->getTitle()); ?></a>
                    <td data-label="<?= $this->getHtml('Author') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($news->getCreatedBy()->getName1()); ?></a>
                    <td data-label="<?= $this->getHtml('Date') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($news->getPublish()->format('Y-m-d')); ?></a>
                        <?php endforeach; ?>
                        <?php if ($count === 0) : ?>
                <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>
