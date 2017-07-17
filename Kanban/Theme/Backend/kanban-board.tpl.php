<?php
$board = $this->getData('board');
$columns = $board->getColumns();
// todo: column width should be % but with min-width and on small screens full width
?>
<div class="row">
    <?php $i = 0; foreach($columns as $column) : $i++; $cards = $column->getCards(); ?>
    <div id="kanban-column-<?= $i; ?>" class="col-xs-12 col-sm-3" draggable="true">
        <header><?= $column->getName(); ?></header>
        <?php $j = 0; foreach($cards as $card) : $j++; $labels = $card->getLabels(); ?>
            <a href="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/kanban/card?{?}&id=' . $card->getId()) ?>">
            <section id="kanban-card-<?= $i . '-' . $j; ?>" class="box wf-100" draggable="true">
                <header><h1><?= $card->getName(); ?></h1></header>
                <div class="inner">
                    <?= $card->getDescription(); ?>
                    <?php foreach($labels as $label) : ?>
                    <span class="tag" style="background: #<?= dechex($label->getColor()); ?>"><?= $label->getName(); ?></span>
                    <?php endforeach; ?>
                </div>
            </section>
            </a>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</div>