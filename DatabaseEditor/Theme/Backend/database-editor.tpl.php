<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
use phpOMS\DataStorage\Database\DatabaseType;

$dbTypes = DatabaseType::getConstants();

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-3">
        <section class="box wf-100">
            <div class="inner">
                <form id="fDatabaseConnection" method="GET" action="<?= \phpOMS\Uri\UriFactory::build('{/api}dbeditor/editor?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100" style="table-layout: fixed">
                        <tbody>
                        <tr><td><label for="iDatabaseType"><?= $this->getHtml('DatabaseType') ?></label>
                        <tr><td>
                            <select id="iDatabaseType" name="type">
                                <?php foreach ($dbTypes as $type): ?>
                                <option value="<?= $this->printHtml($type); ?>"><?= $this->printHtml($type) ?>
                                <?php endforeach; ?>
                            </select>
                        <tr><td><label for="iHost"><?= $this->getHtml('Host') ?></label>
                        <tr><td><input type="text" id="iHost" name="host">
                        <tr><td><label for="iPort"><?= $this->getHtml('Port') ?></label>
                        <tr><td><input min="0" max="65536" type="number" id="iPort" name="port">
                        <tr><td><label for="iDatabase"><?= $this->getHtml('Database') ?></label>
                        <tr><td><input type="text" id="iDatabase" name="database">
                        <tr><td><label for="iLogin"><?= $this->getHtml('Login') ?></label>
                        <tr><td><input type="text" id="iLogin" name="login">
                        <tr><td><label for="iPassword"><?= $this->getHtml('Password') ?></label>
                        <tr><td><input type="text" id="iPassword" name="password">
                        <tr><td><input type="submit" value="<?= $this->getHtml('Test'); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-9">
        <section class="box wf-100">
            <div class="inner">
                <table class="layout wf-100" style="table-layout: fixed">
                    <tbody>
                    <tr><td><textarea style="height: 350px" form="fDatabaseConnection"></textarea>
                    <tr><td><input form="fDatabaseConnection" type="submit" value="<?= $this->getHtml('Execute'); ?>">
                </table>
            </div>
        </section>
    </div>
</div>

<div class="tabview tab-2">
    <div class="box wf-100 col-xs-12">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->getHtml('Query'); ?></label></li>
            <li><label for="c-tab-2"><?= $this->getHtml('Database'); ?></label></li>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2" checked>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <section class="box wf-100">
                        <div class="inner">
                            <div class="ipt-wrap">
                                <div class="ipt-first">
                                    <select id="iExport" name="type">
                                        <option value="excel"><?= $this->getHtml('Excel') ?>
                                        <option value="csv"><?= $this->getHtml('CSV') ?>
                                        <option value="json"><?= $this->getHtml('JSON') ?>
                                    </select>
                                </div>
                                <div class="ipt-second"><button><?= $this->getHtml('Export') ?></button></div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12">
                    <table class="table darkred">
                    <caption><?= $this->getHtml('QueryResult') ?> - <?= $this->getHtml('Limit1000') ?><i class="fa fa-download floatRight download btn"></i></caption>
                    <thead>
                    <tbody>
                        <tr><td><?= $this->getHtml('NoResults') ?>
                    </table>
                </div>
            </div>
        </div>
        <input type="radio" id="c-tab-2" name="tabular-2">
        <div class="tab">
            <div class="row">
                <div class="col-xs-3">
                    <section class="box wf-100">
                        <div class="inner">
                        </div>
                    </section>
                </div>

                <div class="col-xs-9">
                    <section class="box wf-100">
                        <div class="inner">
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
