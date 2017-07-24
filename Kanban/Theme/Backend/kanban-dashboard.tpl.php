<?php
$boards = $this->getData('boards');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <?php foreach($boards as $board) : ?>  
    <div class="col-xs-12 col-sm-6 col-lg-3">
        <a href="<?= htmlspecialchars(\phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/kanban/board?{?}&id=' . $board->getId()) , ENT_COMPAT, 'utf-8'); ?>">
        <section class="box wf-100">
            <header><h1><?= htmlspecialchars($board->getName(), ENT_COMPAT, 'utf-8'); ?></h1></header>
            <div class="inner">
                <?= htmlspecialchars($board->getDescription(), ENT_COMPAT, 'utf-8'); ?>
            </div>
        </section>
        </a>
    </div>
    <?php endforeach; ?>
<div>