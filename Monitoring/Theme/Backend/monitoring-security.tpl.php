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
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('PHPSettings'); ?></h1></header>
            <div class="inner">
                <table class="list wf-100">
                    <tbody>
                        <tr><td><?= $this->getHtml('DeprecatedFunctions'); ?><td><?= \phpOMS\Security\PhpCode::isDisabled(\phpOMS\Security\PhpCode::$disabledFunctions); ?>
                </table>
            </div>
        </section>
    </div>
</div>
