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
$jobs = [];

echo $this->getData('nav')->render(); ?>

<div class="box w-100 floatLeft">
    <table class="table">
        <caption><?= $this->getText('Job'); ?></caption>
        <thead>
        <td><?= $this->getText('Status'); ?>
        <td><?= $this->getText('Next'); ?>
        <td class="full"><?= $this->getText('Title'); ?>
        <td><?= $this->getText('Creator'); ?>
        <td><?= $this->getText('Created'); ?>
        <tfoot>
        <tbody>
        <?php $c = 0; foreach($jobs as $key => $workflow) : $c++;
        $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/task/single?id=' . $workflow->getId());
        $color = 'darkred';
        if($workflow->getStatus() === \Modules\Job\Models\JobStatus::RUNNING) { $color = 'blue'; }
        elseif($workflow->getStatus() === \Modules\Job\Models\JobStatus::WAITING) { $color = 'yellow'; }
        elseif($workflow->getStatus() === \Modules\Job\Models\JobStatus::DONE) { $color = 'green'; }
        elseif($workflow->getStatus() === \Modules\Job\Models\JobStatus::SUSPENDED) { $color = 'red'; } ;?>
        <tr>
            <td><a href="<?= $url; ?>"><span class="tag <?= $color; ?>"><?= $this->getText('S' . $workflow->getStatus()); ?></span></a>
            <td><a href="<?= $url; ?>"><?= $workflow->getDue()->format('Y-m-d H:i'); ?></a>
            <td><a href="<?= $url; ?>"><?= $workflow->getTitle(); ?></a>
            <td><a href="<?= $url; ?>"><?= $workflow->getCreatedBy(); ?></a>
            <td><a href="<?= $url; ?>"><?= $workflow->getCreatedAt()->format('Y-m-d H:i'); ?></a>
                <?php endforeach; if($c == 0) : ?>
        <tr><td colspan="6" class="empty"><?= $this->getText('Empty'); ?>
                <?php endif; ?>
    </table>
</div>