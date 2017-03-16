<?php
$card = $this->getData('card');
$comments = $card->getComments();
?>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <header><h1><?= $card->getName(); ?></h1></header>
            <div class="inner">
                <?= $card->getDescription(); ?>
            </div>
        </section>
    </div>
</div>

<?php foreach($comments as $comment) : ?>
<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <div class="inner">
                <?= $comment->getDescription(); ?>
            </div>
        </section>
    </div>
</div>
<?php endforeach; ?>