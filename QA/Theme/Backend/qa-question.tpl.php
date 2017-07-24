<?php
$question = $this->getData('question');
$answers = $question->getAnswers();

echo $this->getData('nav')->render(); 
?>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <header><h1><?= htmlspecialchars($question->getName(), ENT_COMPAT, 'utf-8'); ?></h1></header>
            <div class="inner">
                <?= htmlspecialchars($question->getQuestion(), ENT_COMPAT, 'utf-8'); ?>
            </div>
        </section>
    </div>
</div>

<?php foreach($answers as $answer) : ?>
<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <div class="inner">
                <?= htmlspecialchars($answer->getAnswer(), ENT_COMPAT, 'utf-8'); ?><?= htmlspecialchars($answer->getCreatedAt()->format('Y-m-d'), ENT_COMPAT, 'utf-8'); ?><?= htmlspecialchars($answer->getCreatedBy(), ENT_COMPAT, 'utf-8'); ?><?= htmlspecialchars($answer->getStatus(), ENT_COMPAT, 'utf-8'); ?><?= htmlspecialchars($answer->isAccepted(), ENT_COMPAT, 'utf-8'); ?>
            </div>
        </section>
    </div>
</div>
<?php endforeach; ?>