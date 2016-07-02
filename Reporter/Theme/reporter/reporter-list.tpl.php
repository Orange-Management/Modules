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
$reporterListView = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$headerView       = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);
$footerView       = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);

$reporterListView->setTemplate('/Web/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

/*
 * Header
 */
$headerView->setTitle($this->l11n->getText('Reporter', 'Reporter'));
$headerView->setHeader([
    ['title' => $this->l11n->getText(0, 'ID'], 'sortable' => true),
    ['title' => $this->l11n->getText('Reporter', 'Name'], 'sortable' => true, 'full' => true),
    ['title' => $this->l11n->getText('Reporter', 'Creator'], 'sortable' => true),
    ['title' => $this->l11n->getText('Reporter', 'Created'], 'sortable' => true),
]);

/*
 * Footer
 */
$footerView->setPages(20);
$footerView->setPage(1);

$reporterListView->addView('header', $headerView);
$reporterListView->addView('footer', $footerView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->app, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1002710000);

/*
 * Template
 */
echo $nav->render();
echo $reporterListView->render();
