<?= $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <div class="inner"><article><?= $this->getData('doc')->getContent(); ?></article></div>
        </section>
    </div>
</div>