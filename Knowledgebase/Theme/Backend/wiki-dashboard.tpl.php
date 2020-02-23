<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Knowledgebase
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

use \phpOMS\Uri\UriFactory;

/**
 * @var \Modules\Knowledgebase\Models\WikiCategory[] $categories
 * @var \Modules\Knowledgebase\Models\WikiDoc[] $documents
 */
$categories = $this->getData('categories') ?? [];
$documents  = $this->getData('docs') ?? [];

/**
 * @var \phpOMS\Views\View $this
 */
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-8 col-lg-9">
        <div class="row">
            <?php foreach ($documents as $doc) : ?>
                <section class="box wf-100">
                    <header><h1><?= $doc->getName(); ?></h1></header>
                    <article>
                        <?= $doc->getDoc(); ?>
                    </article>
                </section>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="col-xs-12 col-md-4 col-lg-3">
        <section class="box wf-100">
            <div class="inner">
            <ul>
                <?php foreach ($categories as $category) : ?>
                    <li><a href="<?= UriFactory::build('{/prefix}wiki/doc/list?{?}&id=' . $category->getId()); ?>"><?= $this->printHtml($category->getName()); ?></a>
                <?php endforeach; ?>
            </ul>
            </div>
        </section>
    </div>
</div>