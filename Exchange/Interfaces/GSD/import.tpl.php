<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Import') ?> - GSD</h1></header>

            <div class="inner">
                <form id="fImport" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/admin/exchange/import/profile?{?}&exchange=GSD&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100" style="table-layout: fixed">
                        <tbody>
                        <tr><td><label for="iStart"><?= $this->getHtml('Start') ?></label>
                        <tr><td><input type="datetime-local" id="iStart" name="start" value="<?= $this->printHtml((new \DateTime('NOW'))->format('Y-m-d\TH:i:s')); ?>">
                        <tr><td><label for="iEnd"><?= $this->getHtml('End') ?></label>
                        <tr><td><input type="datetime-local" id="iEnd" name="end" value="<?= $this->printHtml((new \DateTime('NOW'))->format('Y-m-d\TH:i:s')); ?>">
                        <tr><td><?= $this->getHtml('Options') ?>
                        <tr><td>
                            <span class="checkbox">
                                <input id="iCustomers" name="customers" type="checkbox" value="1">
                                <label for="iCustomers"><?= $lang['Customers']; ?></label>
                            </span>
                        <tr><td>
                            <span class="checkbox">
                                <input id="iSuppliers" name="suppliers" type="checkbox" value="1">
                                <label for="iSuppliers"><?= $lang['Suppliers']; ?></label>
                            </span>
                        <tr><td>
                            <span class="checkbox">
                                <input id="iAccounts" name="accounts" type="checkbox" value="1">
                                <label for="iAccounts"><?= $lang['Accounts']; ?></label>
                            </span>
                        <tr><td>
                            <span class="checkbox">
                                <input id="iCostCenters" name="costcenters" type="checkbox" value="1">
                                <label for="iCostCenters"><?= $lang['CostCenters']; ?></label>
                            </span>
                        <tr><td>
                            <span class="checkbox">
                                <input id="iCostObjects" name="costobjects" type="checkbox" value="1">
                                <label for="iCostObjects"><?= $lang['CostObjects']; ?></label>
                            </span>
                        <tr><td>
                            <span class="checkbox">
                                <input id="iArticles" name="articles" type="checkbox" value="1">
                                <label for="iArticles"><?= $lang['Articles']; ?></label>
                            </span>
                        <tr><td>
                            <span class="checkbox">
                                <input id="iInvoices" name="invoices" type="checkbox" value="1">
                                <label for="iInvoices"><?= $lang['Invoices']; ?></label>
                            </span>
                        <tr><td>
                            <input type="submit" value="<?= $this->getHtml('Import'); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>