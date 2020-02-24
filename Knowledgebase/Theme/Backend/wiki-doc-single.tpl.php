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

use Modules\Knowledgebase\Models\NullWikiDoc;
use \phpOMS\Uri\UriFactory;

/**
 * @var \Modules\Knowledgebase\Models\WikiCategory[] $categories
 * @var \Modules\Knowledgebase\Models\WikiDoc        $doc
 */
$categories = $this->getData('categories') ?? [];
$doc        = $this->getData('document') ?? new NullWikiDoc();

/**
 * @var \phpOMS\Views\View $this
 */
echo $this->getData('nav')->render();
?>

<div class="row">
    <div class="col-xs-12 col-md-8 col-lg-9">
        <section class="box wf-100">
            <header><h1><?= $this->printHtml($doc->getName()); ?></h1></header>
            <article><?= $doc->getDoc(); ?></article>
            <div class="inner">
                <span class="tag">Test Tag</span>
            </div>
        </section>
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