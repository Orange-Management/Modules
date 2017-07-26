<?php
$board = $this->getData('board');
$columns = $board->getColumns();
// todo: column width should be % but with min-width and on small screens full width
?>
<div class="row">
    <?php $i = 0; foreach($columns as $column) : $i++; $cards = $column->getCards(); ?>
    <div id="kanban-column-<?= htmlspecialchars($i, ENT_COMPAT, 'utf-8'); ?>" class="col-xs-12 col-sm-3" draggable="true">
        <header><?= htmlspecialchars($column->getName(), ENT_COMPAT, 'utf-8'); ?></header>
        <?php $j = 0; foreach($cards as $card) : $j++; $labels = $card->getLabels(); ?>
            <a href="<?= htmlspecialchars(\phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/kanban/card?{?}&id=' . $card->getId()), ENT_COMPAT, 'utf-8'); ?>">
            <section id="kanban-card-<?= htmlspecialchars($i . '-' . $j, ENT_COMPAT, 'utf-8'); ?>" class="box wf-100" draggable="true">
                <header><h1><?= htmlspecialchars($card->getName(), ENT_COMPAT, 'utf-8'); ?></h1></header>
                <div class="inner">
                    <?= htmlspecialchars($card->getDescription(), ENT_COMPAT, 'utf-8'); ?>
                    <?php foreach($labels as $label) : ?>
                    <span class="tag" style="background: #<?= htmlspecialchars(dechex($label->getColor()), ENT_COMPAT, 'utf-8'); ?>"><?= htmlspecialchars($label->getName(), ENT_COMPAT, 'utf-8'); ?></span>
                    <?php endforeach; ?>
                </div>
            </section>
            </a>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</div>