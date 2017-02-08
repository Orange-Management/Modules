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
$jobs = $this->getData('jobs');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table">
                <caption><?= $this->getText('Job'); ?></caption>
                <thead>
                <td><?= $this->getText('Status'); ?>
                <td><?= $this->getText('Last'); ?>
                <td><?= $this->getText('Next'); ?>
                <td class="full"><?= $this->getText('Title'); ?>
                <td><?= $this->getText('Run'); ?>
                <tfoot>
                <tbody>
                <?php $c = 0; foreach($jobs as $key => $job) : $c++;
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/admin/job/single?{?}id=' . $job->getId()); ?>
                <tr>
                    <td><a href="<?= $url; ?>"><?= $job->getStatus(); ?></a>
                    <td><a href="<?= $url; ?>"><?= !empty($job->getLastRunTime()) ? $job->getLastRunTime()->format('Y-m-d') : ''; ?></a>
                    <td><a href="<?= $url; ?>"><?= !empty($job->getNextRunTime()) ? $job->getNextRunTime()->format('Y-m-d') : ''; ?></a>
                    <td><a href="<?= $url; ?>"><?= trim($job->getId()); ?></a>
                    <td><a href="<?= $url; ?>"><?= $job->getRun(); ?></a>
                        <?php endforeach; if($c == 0) : ?>
                <tr><td colspan="6" class="empty"><?= $this->getText('Empty', 0, 0); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>