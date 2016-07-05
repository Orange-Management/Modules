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

/*
 * UI Logic
 */
$timeMgmtView = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$headerView   = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$timeMgmtView->setTemplate('/Web/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$headerView->setTitle($this->l11n->getText('PersonnelTimeManagement', 'Backend', 'TimeManagement'));
$headerView->setHeader([
    ['title' => '', 'sortable' => false],
    ['title' => $this->l11n->getText('PersonnelTimeManagement', 'Date'], 'Backend', 'sortable' => true),
    ['title' => $this->l11n->getText('PersonnelTimeManagement', 'Status'], 'Backend', 'sortable' => true),
    ['title' => $this->l11n->getText('PersonnelTimeManagement', 'Type'], 'sortable' => true, 'Backend', 'full' => true),
    ['title' => $this->l11n->getText('PersonnelTimeManagement', 'Start'], 'Backend', 'sortable' => true),
    ['title' => $this->l11n->getText('PersonnelTimeManagement', 'End'], 'Backend', 'sortable' => true),
    ['title' => $this->l11n->getText('PersonnelTimeManagement', 'Duration'], 'Backend', 'sortable' => true),
]);
$timeMgmtView->addView('header', $headerView);

/*
 * Settings
 */
/**
 * @var \phpOMS\Views\View $this
 */
$panelSettingsView = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$panelSettingsView->setTemplate('/Web/Templates/Panel/BoxFull');
$panelSettingsView->setTitle($this->l11n->getText('PersonnelTimeManagement', 'Backend', 'Settings'));
$this->addView('settings', $panelSettingsView);

$settingsFormView = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$settingsFormView->setTemplate('/Web/Templates/Forms/FormFull');
$settingsFormView->setHasSubmit(false);
$settingsFormView->setOnChange(true);
$settingsFormView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$settingsFormView->setMethod(\phpOMS\Message\Http\RequestMethod::POST);

$settingsFormView->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::SELECT,
    'options' => [
        ['value' => 0, 'content' => $this->l11n->getText('PersonnelTimeManagement', 'Backend', 'All']),
        ['value' => 1, 'content' => $this->l11n->getText('PersonnelTimeManagement', 'Backend', 'Day']),
        ['value' => 2, 'content' => $this->l11n->getText('PersonnelTimeManagement', 'Backend', 'Week']),
        ['value' => 3, 'content' => $this->l11n->getText('PersonnelTimeManagement', 'Month'], 'Backend', 'selected' => true),
        ['value' => 4, 'content' => $this->l11n->getText('PersonnelTimeManagement', 'Backend', 'Year']),
    ],
    'label'   => $this->l11n->getText('PersonnelTimeManagement', 'Backend', 'Interval'),
    'name'    => 'interval',
]);

$this->getView('settings')->addView('form', $settingsFormView);

/*
 * Statistics
 */
$panelStatView = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$panelStatView->setTemplate('/Web/Templates/Panel/BoxFull');
$panelStatView->setTitle($this->l11n->getText('PersonnelTimeManagement', 'Backend', 'General'));
$this->addView('stats', $panelStatView);

$statTableView = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$statTableView->setTemplate('/Web/Templates/Lists/AssocList');
$statTableView->setElements([
    [$this->l11n->getText('PersonnelTimeManagement', 'Surplus'], 'Backend', '-2.4 hours'),
    [$this->l11n->getText('PersonnelTimeManagement', 'Working'], 'Backend', '136 hours'),
    [$this->l11n->getText('PersonnelTimeManagement', 'Late'], 'Backend', '3'),
    [$this->l11n->getText('PersonnelTimeManagement', 'Vacation'], 'Backend', '5'),
    [$this->l11n->getText('PersonnelTimeManagement', 'Sick'], 'Backend', '1'),
    [$this->l11n->getText('PersonnelTimeManagement', 'Travel'], 'Backend', '17'),
    [$this->l11n->getText('PersonnelTimeManagement', 'Remote'], 'Backend', '2'),
    [$this->l11n->getText('PersonnelTimeManagement', 'Other'], 'Backend', '0'),
]);

$this->getView('stats')->addView('stat::table', $statTableView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->app, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1003501001);
?>
<?= $nav->render(); ?>

<div class="b-7" id="i3-2-1">
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <header><h1><?= $this->l11n->getText('PersonnelTimeManagement', 'Backend', 'Planning'); ?></h1></header>

        <div class="bc-1">
            <button><?= $this->l11n->getText('PersonnelTimeManagement', 'Backend', 'New'); ?></button>
        </div>
    </div>
    <?= $this->getView('settings')->render(); ?>

    <?= $this->getView('stats')->render(); ?>
</div>
<div class="b-6">
    <?= $timeMgmtView->render(); ?>
</div>
