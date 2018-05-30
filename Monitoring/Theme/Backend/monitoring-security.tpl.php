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

use phpOMS\Security\PhpCode;
use phpOMS\System\File\Local\Directory;
use phpOMS\System\File\Local\File;

$files = Directory::listByExtension(__DIR__ . '/../../../../phpOMS/', 'php', 'tests(\/|\\\)');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('PHPSettings'); ?></h1></header>
            <div class="inner">
                <table class="list wf-100">
                    <tbody>
                        <tr><td><?= $this->getHtml('DisabledFunctions'); ?><td><?= PhpCode::isDisabled(PhpCode::$disabledFunctions) ? $this->getHtml('OK') : $this->getHtml('NG'); ?>
                        <tr><td><button><?= $this->getHtml('Inspect'); ?></button>
                </table>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getHtml('Inspection') ?></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('Status') ?>
                    <td class="wf-100"><?= $this->getHtml('File') ?>
                    <td><?= $this->getHtml('Unicode') ?>
                    <td><?= $this->getHtml('Deprecated') ?>
                    <td><?= $this->getHtml('Modified') ?>
                    <td><?= $this->getHtml('Integrity') ?>
                <tbody>
                        <?php foreach ($files as $file) : $content = \file_get_contents(__DIR__ . '/../../../../phpOMS/' . $file); ?>
                        <tr>
                            <td>
                            <td><?= $file; ?>
                            <td><?= PhpCode::hasUnicode($content) ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= PhpCode::hasDeprecatedFunction($content) ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= File::changed(__DIR__ . '/../../../../phpOMS/' . $file)->format('Y-m-d'); ?>
                            <td>
                        <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
