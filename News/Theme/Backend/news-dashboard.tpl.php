<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
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

$newsList = $this->getData('news');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getHtml('News'); ?></caption>
                <thead>
                <tr>
                    <td>
                    <td><?= $this->getHtml('Type') ?>
                    <td class="wf-100"><?= $this->getHtml('Title') ?>
                    <td><?= $this->getHtml('Author') ?>
                    <td><?= $this->getHtml('Date') ?>
                <tbody>
                <?php $count = 0; foreach ($newsList as $key => $news) : $count++;
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/news/article?{?}&id=' . $news->getId());
                $color = 'darkred';
                if ($news->getType() === \Modules\News\Models\NewsType::ARTICLE) { $color = 'green'; }
                elseif ($news->getType() === \Modules\News\Models\NewsType::HEADLINE) { $color = 'purple'; }
                elseif ($news->getType() === \Modules\News\Models\NewsType::LINK) { $color = 'yellow'; }
                ?>
                <tr data-href="<?= $url; ?>">
                    <td><a href="<?= $url; ?>"><?= $news->isFeatured() ? '<i class="fa fa-star favorite"></i>' : ''; ?></a>
                    <td data-label="<?= $this->getHtml('Type') ?>"><a href="<?= $url; ?>"><span class="tag <?= $this->printHtml($color); ?>"><?= $this->getHtml('TYPE' . $news->getType()) ?></span></a>
                    <td data-label="<?= $this->getHtml('Title') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($news->getTitle()); ?></a>
                    <td data-label="<?= $this->getHtml('Author') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($news->getCreatedBy()->getName1()); ?></a>
                    <td data-label="<?= $this->getHtml('Date') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($news->getPublish()->format('Y-m-d')); ?></a>
                        <?php endforeach; ?>
                        <?php if ($count === 0) : ?>
                <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>
