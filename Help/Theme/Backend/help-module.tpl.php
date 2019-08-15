<div class="row">
    <div class="col-xs-12 col-md-8 col-lg-9">
        <section class="box wf-100">
            <article>
                <?= $this->getData('content'); ?>
            </article>
        </section>
    </div>

    <div class="col-xs-12 col-md-4 col-lg-3">
        <div class="box wf-100">
            <a class="button" href="<?= \phpOMS\Uri\UriFactory::build('{/lang}/backend/help/module/single?id={?id}'); ?>">Module</a>
        </div>

        <section class="box wf-100">
            <article>
                <?= $this->getData('navigation'); ?>
            </article>
        </section>
    </div>
</div>