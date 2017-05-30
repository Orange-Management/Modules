<?php
$board = $this->getData('board');
$columns = $board->getColumns();
// todo: column width should be % but with min-width and on small screens full width
?>
<div class="row">
    <?php foreach($columns as $column) : $cards = $column->getCards(); ?>
    <div class="col-xs-12 col-sm-3" draggable>
        <header><?= $column->getName(); ?></header>
        <?php foreach($cards as $card) : $labels = $card->getLabels(); ?>
            <a href="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/kanban/card?{?}&id=' . $card->getId()) ?>">
            <section class="box wf-100" draggable>
                <header><h1><?= $card->getName(); ?></h1></header>
                <div class="inner">
                    <?= $card->getDescription(); ?>
                    <?php foreach($labels as $label) : ?>
                    <span style="background: #<?= dechex($label->getColor()); ?>"><?= $label->getName(); ?></span>
                    <?php endforeach; ?>
                </div>
            </section>
            </a>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</div>