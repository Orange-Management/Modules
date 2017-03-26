<?php
$questions = $this->getData('questions');
?>

<div class="row">
    <div class="col-xs-12">
        <?php foreach($questions as $question) : ?>
        <section class="box wf-100">
            <?= count($question->getAnswers()); ?> <?= $question->getName(); ?>
            <?php $badges = $question->getBadges(); foreach($badges as $badge) : ?>
                <?= $badge->getName(); ?>
            <?php endforeach; ?>
        </section>
        <?php endforeach; ?>
    </div>
</div>
