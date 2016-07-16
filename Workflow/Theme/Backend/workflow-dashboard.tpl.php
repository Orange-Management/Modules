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
$workflows = [];

echo $this->getData('nav')->render(); ?>

<div class="box w-100 floatLeft">
    <table class="table">
        <caption><?= $this->l11n->getText('Workflow', 'Backend', 'Workflow'); ?></caption>
        <thead>
        <td><?= $this->l11n->getText('Workflow', 'Backend', 'Status'); ?>
        <td><?= $this->l11n->getText('Workflow', 'Backend', 'Next'); ?>
        <td class="full"><?= $this->l11n->getText('Workflow', 'Backend', 'Title'); ?>
        <td><?= $this->l11n->getText('Workflow', 'Backend', 'Creator'); ?>
        <td><?= $this->l11n->getText('Workflow', 'Backend', 'Created'); ?>
        <tfoot>
        <tbody>
        <?php $c = 0; foreach($workflows as $key => $workflow) : $c++;
        $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/task/single?id=' . $workflow->getId());
        $color = 'darkred';
        if($workflow->getStatus() === \Modules\Workflow\Models\WorkflowStatus::DONE) { $color = 'green'; }
        elseif($workflow->getStatus() === \Modules\Workflow\Models\WorkflowStatus::OPEN) { $color = 'darkblue'; }
        elseif($workflow->getStatus() === \Modules\Workflow\Models\WorkflowStatus::WORKING) { $color = 'purple'; }
        elseif($workflow->getStatus() === \Modules\Workflow\Models\WorkflowStatus::CANCELED) { $color = 'red'; }
        elseif($workflow->getStatus() === \Modules\Workflow\Models\WorkflowStatus::SUSPENDED) { $color = 'yellow'; } ;?>
        <tr>
            <td><a href="<?= $url; ?>"><span class="tag <?= $color; ?>"><?= $this->l11n->getText('Workflow', 'Backend', 'S' . $workflow->getStatus()); ?></span></a>
            <td><a href="<?= $url; ?>"><?= $workflow->getDue()->format('Y-m-d H:i'); ?></a>
            <td><a href="<?= $url; ?>"><?= $workflow->getTitle(); ?></a>
            <td><a href="<?= $url; ?>"><?= $workflow->getCreatedBy(); ?></a>
            <td><a href="<?= $url; ?>"><?= $workflow->getCreatedAt()->format('Y-m-d H:i'); ?></a>
                <?php endforeach; if($c == 0) : ?>
        <tr><td colspan="6" class="empty"><?= $this->l11n->getText(0, 'Backend', 'Empty'); ?>
                <?php endif; ?>
    </table>
</div>