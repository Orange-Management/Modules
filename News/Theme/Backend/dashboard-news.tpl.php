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
?>
<div id="news-dashboard" class="col-xs-12 col-md-6" draggable>
    <div class="box wf-100">
        <table class="table blue">
            <caption><?= $this->getText('News', 'News') ?></caption>
            <thead>
            <tr>
                <td>
                <td><?= $this->getText('Type', 'News'); ?>
                <td class="wf-100"><?= $this->getText('Title', 'News'); ?>
            <tbody>
            <?php $count = 0; foreach($newsList as $key => $news) : $count++;
            $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/news/article?{?}&id=' . $news->getId());
            $color = 'darkred';
            if($news->getType() === \Modules\News\Models\NewsType::ARTICLE) { $color = 'green'; }
            elseif($news->getType() === \Modules\News\Models\NewsType::HEADLINE) { $color = 'purple'; }
            elseif($news->getType() === \Modules\News\Models\NewsType::LINK) { $color = 'yellow'; }
            ?>
            <tr data-href="<?= $url; ?>">
                <td data-label=""><a href="<?= $url; ?>"><?= $news->isFeatured() ? '<i class="fa fa-star favorite"></i>' : ''; ?></a>
                <td data-label="<?= $this->getText('Type', 'News'); ?>"><a href="<?= $url; ?>"><span class="tag <?= $color; ?>"><?= $this->getText('TYPE' . $news->getType(), 'News'); ?></span></a>
                <td data-label="<?= $this->getText('Title', 'News'); ?>"><a href="<?= $url; ?>"><?= $news->getTitle(); ?></a>
                    <?php endforeach; ?>
                    <?php if($count === 0) : ?>
            <tr><td colspan="5" class="empty"><?= $this->getText('Empty', 0, 0); ?>
                    <?php endif; ?>
        </table>
    </div>
</div>