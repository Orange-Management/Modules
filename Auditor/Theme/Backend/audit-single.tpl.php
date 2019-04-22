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

echo $this->getData('nav')->render();
?>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <article>
                <pre><?= \phpOMS\Utils\StringUtils::createDiffMarkup(
                        \phpOMS\Views\ViewAbstract::html($this->getData('audit')->getOld() ?? ''),
                        \phpOMS\Views\ViewAbstract::html($this->getData('audit')->getNew() ?? ''),
                        "\n"
                    ); ?>
                </pre>
            </article>
        </section>
    </div>
</div>