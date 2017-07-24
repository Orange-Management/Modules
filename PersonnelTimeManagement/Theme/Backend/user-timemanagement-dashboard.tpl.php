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
echo $this->getData('nav')->render();
?>

<div class="box w-100">
    <table class="table red">
        <caption><?= $this->getHtml('Times') ?></caption>
        <thead>
        <tr>
            <td><?= $this->getHtml('Start') ?>
            <td><?= $this->getHtml('End') ?>
            <td class="wf-100"><?= $this->getHtml('Type') ?>
        <tfoot>
        <tr><td colspan="4"><?= htmlspecialchars($footerView->render(), ENT_COMPAT, 'utf-8'); ?>
        <tbody>
        <?php $c = 0; foreach ($employees as $key => $value) : $c++;
            $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/admin/group/settings?{?}&id=' . $value->getId()); ?>
            <tr>
                <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getId(), ENT_COMPAT, 'utf-8'); ?></a>
                <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getNewestHistory()->getPosition(), ENT_COMPAT, 'utf-8'); ?></a>
                <td><a href="<?= $url; ?>"><?= htmlspecialchars($value->getNewestHistory()->getPosition(), ENT_COMPAT, 'utf-8'); ?></a>
        <?php endforeach; ?>
        <?php if($c === 0) : ?>
            <tr><td colspan="4" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
        <?php endif; ?>
    </table>
</div>
