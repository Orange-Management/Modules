<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\QA
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

/**
 * @todo Orange-Management/Modules#73
 *  Profile pics
 *  There are no profile pics in questions and answers. Implement!
 */

$question = $this->getData('question');
$answers  = $question->getAnswers();

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
                <img alt="<?= $this->getHtml('AccountImage', '0', '0'); ?>" data-lazyload="<?= UriFactory::build('{/prefix}' . $question->getCreatedBy()->getImage()->getPath()); ?>">
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