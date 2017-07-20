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
 * @var \phpOMS\Views\View $this
 */

$footerView   = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(20);
$footerView->setPage(1);

$articles = $this->getData('articles');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getText('Archive') ?></caption>
                <thead>
                <tr>
                    <td><?= $this->getText('Type'); ?>
                    <td class="wf-100"><?= $this->getText('Title'); ?>
                    <td><?= $this->getText('Author'); ?>
                    <td><?= $this->getText('Date'); ?>
                        <tfoot>
                <tr>
                    <td colspan="4"><?= $footerView->render(); ?>
                        <tbody>
                        <?php $count = 0; foreach($articles as $key => $news) : $count++; $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/news/article?{?}&id=' . $news->getId());
                            $color = 'darkred';
                            if($news->getType() === \Modules\News\Models\NewsType::ARTICLE) { $color = 'green'; }
                            elseif($news->getType() === \Modules\News\Models\NewsType::HEADLINE) { $color = 'purple'; }
                            elseif($news->getType() === \Modules\News\Models\NewsType::LINK) { $color = 'yellow'; } 
                        ?>
                            <tr>
                                <td><span class="tag <?= $color; ?>"><?= $this->getText('TYPE' . $news->getType()); ?></span></a>
                                <td><a href="<?= $url; ?>"><?= $news->getTitle(); ?></a>
                                <td><a href="<?= $url; ?>"><?= $news->getCreatedBy()->getName1(); ?></a>
                                <td><a href="<?= $url; ?>"><?= $news->getPublish()->format('Y-m-d'); ?></a>
                        <?php endforeach; ?>
                        <?php if($count === 0) : ?>
                <tr><td colspan="4" class="empty"><?= $this->getText('Empty', 0, 0); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>
