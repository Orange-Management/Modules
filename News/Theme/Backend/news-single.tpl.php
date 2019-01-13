<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
/**
 * @var \phpOMS\Views\View $this
 */

$news = $this->getData('news');

echo $this->getData('nav')->render(); ?>
<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <article><?= $news->getContent(); ?></article>
        </section>
    </div>
</div>