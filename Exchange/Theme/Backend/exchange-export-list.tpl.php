<?php
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

/**
 * @var \phpOMS\Views\View         $this
 */
echo $this->getData('nav')->render(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getHtml('Exports') ?></caption>
                <thead>
                <tr>
                    <td class="wf-100"><?= $this->getHtml('Title') ?>
                    <td><?= $this->getHtml('Website') ?>
                <tfoot>
                <tr>
                    <td colspan="2">
                <tbody>
                <?php $count = 0; foreach ($interfaces as $key => $value) : $count++;
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/admin/exchange/export/profile?{?}&id=' . $value->getId()); ?>
                    <tr data-href="<?= $url; ?>">
                        <td data-label="<?= $this->getHtml('Title') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getTitle()); ?></a>
                        <td data-label="<?= $this->getHtml('Website') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getCreatedBy()->getName1()); ?></a>
                <?php endforeach; ?>
                <?php if ($count === 0) : ?>
                <tr><td colspan="2" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>
