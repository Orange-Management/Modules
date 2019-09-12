<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   TBD
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
/**
 * @var \phpOMS\Views\View $this
 */

$news = $this->getData('news');

echo $this->getData('nav')->render(); ?>
<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <article>
                <h1><?= $this->printHtml($news->getTitle()); ?></h1>
                <?= $news->getContent(); ?>
            </article>
        </section>
    </div>
</div>