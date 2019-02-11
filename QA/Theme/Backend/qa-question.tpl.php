<?php
$question = $this->getData('question');
$answers = $question->getAnswers();

echo $this->getData('nav')->render();
?>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <header><h1><?= $this->printHtml($question->getName()); ?></h1></header>
            <div class="inner">
                <?= $this->printHtml($question->getQuestion()); ?>
            </div>
            <div class="inner">
                <img alt="<?= $this->getHtml('AccountImage', 0, 0); ?>" data-lazyload="<?= UriFactory::build('' . $question->getCreatedBy()->getImage()->getPath()); ?>">
            </div>
        </section>
    </div>
</div>

<?php foreach ($answers as $answer) : ?>
<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <div class="inner">
                <?= $this->printHtml($answer->getAnswer()); ?><?= $this->printHtml($answer->getCreatedAt()->format('Y-m-d')); ?><?= $this->printHtml($answer->getCreatedBy()); ?><?= $this->printHtml($answer->getStatus()); ?><?= $this->printHtml($answer->isAccepted()); ?>
            </div>
        </section>
    </div>
</div>
<?php endforeach; ?>