<?php declare(strict_types=1);

use Modules\Exchange\Models\ExchangeType;

?>
<div class="tabview tab-2">
    <div class="box wf-100 col-xs-12">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->getHtml('File'); ?></label></li>
            <li><label for="c-tab-2"><?= $this->getHtml('Database'); ?></label></li>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2" checked>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <section class="box wf-100">
                        <header>
                            <h1><?= $this->getHtml('Import') ?> - Orange Management</h1>
                        </header>

                        <div class="inner">
                            <form id="fImport" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/api}admin/exchange/import/profile?{?}&exchange=GSD&csrf={$CSRF}'); ?>">
                                <table class="layout wf-100" style="table-layout: fixed">
                                    <tbody>
                                        <tr>
                                            <td><label for="iHost"><?= $this->getHtml('Host') ?></label>
                                        <tr>
                                            <td><input type="file" id="iFile" name="file" placeholder="&#xf040; <?= $this->getHtml('Host') ?>" data-uri="api/exchange/file" required><input type="hidden" id="iUploaded" name="uploaded">
                                        <tr>
                                            <td><?= $this->getHtml('Options') ?>
                                        <tr>
                                            <td>
                                                <select>
                                                    <option value="<?= ExchangeType::CUSTOMER; ?>"><?= $this->getHtml('Customer') ?>
                                                    <option value="<?= ExchangeType::SUPPLIER; ?>"><?= $this->getHtml('Supplier') ?>
                                                    <option value="<?= ExchangeType::ARTICLE; ?>"><?= $this->getHtml('Article') ?>
                                                    <option value="<?= ExchangeType::BOOKING; ?>"><?= $this->getHtml('Booking') ?>
                                                    <option value="<?= ExchangeType::ACCOUNT; ?>"><?= $this->getHtml('Account') ?>
                                                    <option value="<?= ExchangeType::COSTCENTER; ?>"><?= $this->getHtml('CostCenter') ?>
                                                    <option value="<?= ExchangeType::COSTOBJECT; ?>"><?= $this->getHtml('CostObject') ?>
                                                    <option value="<?= ExchangeType::ADDRESS; ?>"><?= $this->getHtml('Address') ?>
                                                </select>
                                        <tr>
                                            <td><label for="iStart"><?= $this->getHtml('Start') ?></label>
                                        <tr>
                                            <td><input type="datetime-local" id="iStart" name="start" value="<?= $this->printHtml((new \DateTime('NOW'))->format('Y-m-d\TH:i:s')); ?>">
                                        <tr>
                                            <td><label for="iEnd"><?= $this->getHtml('End') ?></label>
                                        <tr>
                                            <td><input type="datetime-local" id="iEnd" name="end" value="<?= $this->printHtml((new \DateTime('NOW'))->format('Y-m-d\TH:i:s')); ?>">
                                        <tr>
                                            <td>
                                                <input type="submit" value="<?= $this->getHtml('Import'); ?>">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <input type="radio" id="c-tab-2" name="tabular-2">
        <div class="tab">
        </div>
    </div>
</div>