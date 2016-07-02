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
$tabView = new \Web\Views\Divider\TabularView($this->app, $this->request, $this->response);
$tabView->setTemplate('/Web/Templates/Divider/Tabular');

echo $this->getData('nav')->render(); ?>

<div class="b-7" id="i3-2-1">
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <ul class="l-1">
                <li>
                    <a href="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/backend/reporter/single?id=' . $this->getData('name')); ?>"
                       class="button"><?= $this->l11n->getText('Reporter', 'Report'); ?></a>
            </ul>
        </div>
    </div>
</div>
<div class="b-6">
    <?php
    /**
     * @var \phpOMS\Views\View $this
     */
    $overviwPanel    = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
    $permissionPanel = clone $overviwPanel;

    $overviwPanel->setTitle($this->l11n->getText(0, 'Create'));
    $permissionPanel->setTitle($this->l11n->getText('Reporter', 'Permission'));

    $this->addView('createFormPanel', $overviwPanel);
    $this->getView('createFormPanel')->setTemplate('/Web/Templates/Panel/BoxHalf');

    $this->addView('permissionFormPanel', $permissionPanel);
    $this->getView('permissionFormPanel')->setTemplate('/Web/Templates/Panel/BoxHalf');

    /*
     * Overview
     */

    $formOverview = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
    $formOverview->setTemplate('/Web/Templates/Forms/FormFull');
    $formOverview->setSubmit('submit1', $this->l11n->getText('Reporter', 'Edit'));
    $formOverview->setSubmit('submit2', $this->l11n->getText(0, 'Delete'));
    $formOverview->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
    $formOverview->setMethod(\phpOMS\Message\Http\RequestMethod::POST);

    $formOverview->setElement(0, 0, [
        'type'    => \phpOMS\Html\TagType::INPUT,
        'subtype' => 'text',
        'name'    => 'rname',
        'label'   => $this->l11n->getText('Reporter', 'Name'),
    ]);

    $formOverview->setElement(1, 0, [
        'type'    => \phpOMS\Html\TagType::INPUT,
        'subtype' => 'text',
        'name'    => 'mdirectory',
        'label'   => $this->l11n->getText('Reporter', 'MediaDirectory'),
        'active'  => false,
    ]);

    $formOverview->setElement(1, 1, [
        'type'    => \phpOMS\Html\TagType::BUTTON,
        'content' => $this->l11n->getText('Reporter', 'Select'),
    ]);

    $formOverview->setElement(2, 0, [
        'type'    => \phpOMS\Html\TagType::INPUT,
        'subtype' => 'text',
        'name'    => 'template',
        'label'   => $this->l11n->getText('Reporter', 'Template'),
        'active'  => false,
    ]);

    $formOverview->setElement(2, 1, [
        'type'    => \phpOMS\Html\TagType::BUTTON,
        'content' => $this->l11n->getText('Reporter', 'Select'),
    ]);

    $this->getView('createFormPanel')->addView('form', $formOverview);

    /*
     * Permission Add
     */

    $formPermissionAdd = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
    $formPermissionAdd->setTemplate('/Web/Templates/Forms/FormFull');
    $formPermissionAdd->setSubmit('submit1', $this->l11n->getText(0, 'Add'));
    $formPermissionAdd->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
    $formPermissionAdd->setMethod(\phpOMS\Message\Http\RequestMethod::POST);

    $formPermissionAdd->setElement(0, 0, [
        'type'     => \phpOMS\Html\TagType::SELECT,
        'options'  => [
            [
                'value'   => 0,
                'content' => 'Group',
            ],
            [
                'value'   => 1,
                'content' => 'Account',
            ],
        ],
        'selected' => '',
        'label'    => $this->l11n->getText('Reporter', 'Type'),
        'name'     => 'type',
    ]);

    $formPermissionAdd->setElement(1, 0, [
        'type'    => \phpOMS\Html\TagType::INPUT,
        'subtype' => 'text',
        'name'    => 'id',
        'label'   => $this->l11n->getText(0, 'ID'),
    ]);

    $formPermissionAdd->setElement(2, 0, [
        'type'    => \phpOMS\Html\TagType::INPUT,
        'subtype' => 'text',
        'name'    => 'perm',
        'label'   => $this->l11n->getText('Reporter', 'Permission'),
    ]);

    $this->getView('permissionFormPanel')->addView('form', $formPermissionAdd);

    /*
     * Permission List
     */
    $permissionListView = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
    $headerView         = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

    $permissionListView->setTemplate('/Web/Templates/Lists/ListFull');
    $headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

    /*
     * Header
     */
    $headerView->setTitle($this->l11n->getText('Reporter', 'Permission'));
    $headerView->setHeader([
        ['title' => $this->l11n->getText('Reporter', 'Type'], 'sortable' => true),
        ['title' => $this->l11n->getText('Reporter', 'Name'], 'sortable' => true, 'full' => true),
        ['title' => $this->l11n->getText('Reporter', 'Permission'], 'sortable' => true),
    ]);

    $permissionListView->addView('header', $headerView);
    $this->addView('permissionList', $permissionListView);

    $tabView->addTab($this->l11n->getText('Reporter', 'Overview'), $overviwPanel->render() . $permissionPanel->render() . $permissionListView->render(), 'overview');

    /*
 * UI Logic
 */
    $sourceList           = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
    $sourceListHeaderView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

    $sourceList->setTemplate('/Web/Templates/Lists/ListFull');
    $sourceListHeaderView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

    /*
     * Header
     */
    $sourceListHeaderView->setTitle($this->l11n->getText('Reporter', 'Sources'));
    $sourceListHeaderView->setHeader([
        ['title' => $this->l11n->getText(0, 'ID'], 'sortable' => true),
        ['title' => $this->l11n->getText('Reporter', 'Name'], 'sortable' => true, 'full' => true),
        ['title' => $this->l11n->getText('Reporter', 'Created'], 'sortable' => true),
        ['title' => $this->l11n->getText('Reporter', 'CreatedBy'], 'sortable' => true),
    ]);

    $sourceList->setFreeze(3, 2);
    $sourceList->addView('header', $sourceListHeaderView);

    $tabView->addTab($this->l11n->getText('Reporter', 'Sources'), $sourceList->render(), 'sources');

    /*
     * Create
     */
    $createPanel = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
    $mediaPanel  = clone $createPanel;

    $createPanel->setTitle($this->l11n->getText(0, 'Create'));
    $mediaPanel->setTitle($this->l11n->getText('Reporter', 'Media'));

    $this->addView('createFormPanel', $createPanel);
    $this->getView('createFormPanel')->setTemplate('/Web/Templates/Panel/BoxHalf');

    $this->addView('permissionFormPanel', $mediaPanel);
    $this->getView('permissionFormPanel')->setTemplate('/Web/Templates/Panel/BoxHalf');

    $formCreateForm = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
    $formCreateForm->setTemplate('/Web/Templates/Forms/FormFull');
    $formCreateForm->setSubmit('submit1', $this->l11n->getText(0, 'Submit'));
    $formCreateForm->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
    $formCreateForm->setMethod(\phpOMS\Message\Http\RequestMethod::POST);

    $formCreateForm->setElement(0, 0, [
        'type'    => \phpOMS\Html\TagType::INPUT,
        'subtype' => 'text',
        'name'    => 'rname',
        'label'   => $this->l11n->getText('Reporter', 'Name'),
    ]);

    $createPanel->addView('createform', $formCreateForm);

    /*
     * Media Add
     */

    // TODO: add media upload drop panel

    $tabView->addTab($this->l11n->getText('Reporter', 'New'), $createPanel->render() . $mediaPanel->render(), 'new');
    ?>
    <?= $tabView->render(); ?>
</div>

<script>
    jsOMS.ready(function () {
        assetManager.load(Url + '/Modules/Media/JS', 'MediaUpload.js', 'js');
    });
</script>
