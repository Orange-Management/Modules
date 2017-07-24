<?php 

$doc = $this->getData('doc');

/**
 * @var \phpOMS\Views\View $this
 */
echo $this->getData('nav')->render();
?>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <header><h1><?= htmlspecialchars($doc->getTitle(), ENT_COMPAT, 'utf-8'); ?></h1></header>
            <div class="inner">
                <article>
                    <?= htmlspecialchars($doc->getDoc(), ENT_COMPAT, 'utf-8'); ?>
                </article>
            </div>
        </section>
    </div>
</div>