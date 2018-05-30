<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Task') ?></h1></header>

            <div class="inner">
                <form id="fTask" method="PUT" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/task?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100" style="table-layout: fixed">
                        <tbody>
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>