<?php
$questions = $this->getData('questions');
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <?php foreach($questions as $question) : ?>
        <section class="box wf-100 qa-list">
            <div class="inner">
                <div class="row middle-xs">
                    <div class="col-xs-1 scores">
                        <span class="score<?= htmlspecialchars($question->hasAccepted() ? ' done' : '', ENT_COMPAT, 'utf-8'); ?>"><?= htmlspecialchars(count($question->getAnswers()), ENT_COMPAT, 'utf-8'); ?></span>
                    </div>
                    <div class="title col-xs-11">
                        <a href="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/qa/question?{?}&id=' . $question->getId()) , ENT_COMPAT, 'utf-8'); ?>"><?= htmlspecialchars($question->getName(); ?></a>
                    </div>
                </div>
                <div class="tags">
                <?php $badges = $question->getBadges(); foreach($badges as $badge) : ?>
                    <span class="tag red"><?= htmlspecialchars($badge->getName(), ENT_COMPAT, 'utf-8'); ?></span>
                <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endforeach; ?>
    </div>
</div>
