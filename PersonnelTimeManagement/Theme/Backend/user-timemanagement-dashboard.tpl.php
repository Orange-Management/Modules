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
echo $this->getData('nav')->render();
?>

<div class="box w-100">
    <table class="table">
        <caption><?= $this->l11n->getText('PersonnelTimeManagement', 'Times'); ?></caption>
        <thead>
        <tr>
            <td><?= $this->l11n->getText('PersonnelTimeManagement', 'Start'); ?>
            <td><?= $this->l11n->getText('PersonnelTimeManagement', 'End'); ?>
            <td class="wf-100"><?= $this->l11n->getText('PersonnelTimeManagement', 'Type'); ?>
        <tfoot>
        <tr><td colspan="4"><?= $footerView->render(); ?>
        <tbody>
        <?php $c = 0; foreach ($employees as $key => $value) : $c++;
            $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/admin/group/settings?id=' . $value->getId()); ?>
            <tr>
                <td><a href="<?= $url; ?>"><?= $value->getId(); ?></a>
                <td><a href="<?= $url; ?>"><?= $value->getNewestHistory()->getPosition(); ?></a>
                <td><a href="<?= $url; ?>"><?= $value->getNewestHistory()->getPosition(); ?></a>
        <?php endforeach; ?>
        <?php if($c === 0) : ?>
            <tr><td colspan="4" class="empty"><?= $this->l11n->getText(0, 'Empty'); ?>
        <?php endif; ?>
    </table>
</div>
