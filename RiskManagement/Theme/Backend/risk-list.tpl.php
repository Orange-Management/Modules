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
$risks = $this->getData('risks');
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getText('Causes'); ?></caption>
                <thead>
                <tr>
                    <td><?= $this->getText('ID', 0, 0); ?>
                    <td class="wf-100"><?= $this->getText('Title'); ?>
                    <td><?= $this->getText('Causes'); ?>
                    <td><?= $this->getText('Solutions'); ?>
                    <td><?= $this->getText('Risk Objects'); ?>
                        <tfoot>
                <tr><td colspan="3">
                        <tbody>
                        <?php $c = 0; foreach ($risks as $key => $value) : $c++;
                        $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/riskmanagement/cause/single?{?}&id=' . $value->getId()); ?>
                <tr data-href="<?= $url; ?>">
                    <td><a href="<?= $url; ?>"><?= $value->getId(); ?></a>
                    <td><a href="<?= $url; ?>"><?= $value->getName(); ?></a>
                    <td><a href="<?= $url; ?>"><?= count($value->getCauses()) ?></a>
                    <td><a href="<?= $url; ?>"><?= count($value->getSolutions()) ?></a>
                    <td><a href="<?= $url; ?>"><?= count($value->getRiskObjects()) ?></a>
                        <?php endforeach; ?>
                        <?php if($c === 0) : ?>
                        <tr><td colspan="3" class="empty"><?= $this->getText('Empty', 0, 0); ?>
                                <?php endif; ?>
            </table>
        </div>
    </div>
</div>