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
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \phpOMS\Views\View $this
 */

$templates = \Modules\Reporter\Models\TemplateMapper::listResults(
    \Modules\Reporter\Models\TemplateMapper::find('reporter_template.reporter_template_id',
        'reporter_template.reporter_template_title',
        'reporter_template.reporter_template_creator',
        'reporter_template.reporter_template_created')
//->newest('reporter_template.reporter_template_created')
);

$footerView = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

$footerView->setPages(count($templates) / 25);
$footerView->setPage(1);
$footerView->setResults(count($templates));

echo $this->getData('nav')->render(); ?>

<div class="box w-100">
    <table class="table">
        <caption><?= $this->getText('Reports'); ?></caption>
        <thead>
        <tr>
            <td><?= $this->getText('ID', 0, 0); ?>
            <td class="wf-100"><?= $this->getText('Name'); ?>
            <td><?= $this->getText('Creator'); ?>
            <td><?= $this->getText('Updated'); ?>
        <tfoot>
        <tr>
            <td colspan="4"><?= $footerView->render(); ?>
        <tbody>
        <?php if (count($templates) == 0) : ?>
        <tr class="empty">
            <td colspan="4"><?= $this->getText('Empty', 0, 0); ?>
                <?php endif; ?>
                <?php foreach ($templates as $key => $template) :
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/reporter/report/view?id=' . $template->getId()); ?>
        <tr>
            <td><a href="<?= $url; ?>"><?= $template->getId(); ?></a>
            <td><a href="<?= $url; ?>"><?= $template->getName(); ?></a>
            <td><a href="<?= $url; ?>"><?= $template->getCreatedBy(); ?></a>
            <td><a href="<?= $url; ?>"><?= $template->getCreatedAt()->format('Y-m-d'); ?></a>
                <?php endforeach; ?>
    </table>
</div>

