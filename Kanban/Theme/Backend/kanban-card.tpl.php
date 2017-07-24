<?php
$card = $this->getData('card');
$comments = $card->getComments();
?>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <header><h1><?= htmlspecialchars($card->getName(), ENT_COMPAT, 'utf-8'); ?></h1></header>
            <div class="inner">
                <?= htmlspecialchars($card->getDescription(), ENT_COMPAT, 'utf-8'); ?>
            </div>
        </section>
    </div>
</div>

<?php foreach($comments as $comment) : ?>
<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <div class="inner">
                <?= htmlspecialchars($comment->getDescription(), ENT_COMPAT, 'utf-8'); ?>
            </div>
        </section>
    </div>
</div>
<?php endforeach; ?>