<?php
$questions = $this->getData('questions');
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <?php foreach($questions as $question) : ?>
        <section class="box wf-100 qa-list">
            <div class=".score"><?= count($question->getAnswers()); ?><div><h1><?= $question->getName(); ?></h1>
            <?php $badges = $question->getBadges(); foreach($badges as $badge) : ?>
                <?= $badge->getName(); ?>
            <?php endforeach; ?>
        </section>
        <?php endforeach; ?>
    </div>
</div>
