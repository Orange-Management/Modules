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

$templateMapper = new \Modules\Reporter\Models\TemplateMapper($this->app->dbPool->get());
$templates      = $templateMapper
    ->listResults(
        $templateMapper
            ->find('reporter_template.reporter_template_id',
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

<section class="box w-100">
    <table class="table">
        <caption><?= $this->l11n->lang['Reporter']['Reports']; ?></caption>
        <thead>
        <tr>
            <td><?= $this->l11n->lang[0]['ID']; ?>
            <td class="wf-100"><?= $this->l11n->lang['Reporter']['Name']; ?>
            <td><?= $this->l11n->lang['Reporter']['Creator']; ?>
            <td><?= $this->l11n->lang['Reporter']['Updated']; ?>
                <tfoot>
        <tr><td colspan="4"><?= $footerView->render(); ?>
                <tbody>
                <?php if(count($templates) == 0) : ?>
                    <tr class="empty"><td colspan="4"><?= $this->l11n->lang[0]['Empty']; ?>
                <?php endif; ?>
                <?php foreach ($templates as $key => $template) :
                $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/reporter/single?id=' . $template->getId()); ?>
        <tr>
            <td><a href="<?= $url; ?>"><?= $template->getId(); ?></a>
            <td><a href="<?= $url; ?>"><?= $template->getName(); ?></a>
            <td><a href="<?= $url; ?>"><?= $template->getCreatedBy(); ?></a>
            <td><a href="<?= $url; ?>"><?= $template->getCreatedAt()->format('Y-m-d'); ?></a>
                <?php endforeach; ?>
    </table>
</section>

