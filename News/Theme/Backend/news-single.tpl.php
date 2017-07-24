<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/**
 * @var \phpOMS\Views\View $this
 */

$news = $this->getData('news');

echo $this->getData('nav')->render(); ?>
<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <header><h1><?= htmlspecialchars($news->getTitle(), ENT_COMPAT, 'utf-8'); ?></h1></header>
            <div class="inner">
                <article>
                    <?= htmlspecialchars($news->getContent(), ENT_COMPAT, 'utf-8'); ?>
                </article>
            </div>
        </section>
    </div>
</div>