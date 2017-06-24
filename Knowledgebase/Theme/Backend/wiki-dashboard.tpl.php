<?php
$categories = $this->getData('categories');
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <?php foreach($categories as $category) : ?>
        <section class="box wf-100">
            <?= $category->getName(); ?>
        </section>
        <?php endforeach; ?>
    </div>
</div>
