<?php
$boards = $this->getData('boards');
?>
<div class="row">
    <?php foreach($boards as $board) : ?>  
    <div class="col-xs-12 col-sm-6 col-lg-3">
        <a href="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/backend/kanban/board?{?}&id=' . $board->getId()) ?>">
        <section class="box wf-100">
            <header><h1><?= $board->getName(); ?></h1></header>
            <div class="inner">
                <?= $board->getDescription(); ?>
            </div>
        </section>
        </a>
    </div>
    <?php endforeach; ?>
<div>