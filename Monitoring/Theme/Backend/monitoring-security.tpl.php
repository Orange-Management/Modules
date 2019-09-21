<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Monitoring
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */

use phpOMS\Message\Http\Request;
use phpOMS\Message\Http\Rest;
use phpOMS\Security\PhpCode;
use phpOMS\System\File\Local\Directory;
use phpOMS\System\File\Local\File;
use phpOMS\Uri\Http;

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
            <table class="default">
                <caption><?= $this->getHtml('Inspection') ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('Status') ?>
                    <td class="wf-100"><?= $this->getHtml('File') ?>
                    <td><?= $this->getHtml('Unicode') ?>
                    <td><?= $this->getHtml('Deprecated') ?>
                    <td><?= $this->getHtml('Modified') ?>
                    <td><?= $this->getHtml('Integrity') ?>
                <tbody>
                        <?php
                        $files = Directory::listByExtension(__DIR__ . '/../../../../phpOMS/', 'php', 'tests(\/|\\\)');
                        foreach ($files as $file) : $content = \file_get_contents(__DIR__ . '/../../../../phpOMS/' . $file); ?>
                        <tr>
                            <td>
                            <td><?= $file; ?>
                            <td><?= PhpCode::hasUnicode($content) ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= PhpCode::hasDeprecatedFunction($content) ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= File::changed(__DIR__ . '/../../../../phpOMS/' . $file)->format('Y-m-d'); ?>
                            <td>
                                <?= \phpOMS\Security\PhpCode::validateStringIntegrity(
                                    $content,
                                    Rest::request(
                                        new Request(
                                            new Http('https://raw.githubusercontent.com/Orange-Management/phpOMS/develop/' . $file)
                                        )
                                    )->getBody()
                                ) ? $this->getHtml('OK') : $this->getHtml('NG'); ?>
                        <?php endforeach; ?>
                        <?php
                        $files = Directory::listByExtension(__DIR__ . '/../../../../Model/', 'php', 'tests(\/|\\\)');
                        foreach ($files as $file) : $content = \file_get_contents(__DIR__ . '/../../../../Model/' . $file); ?>
                        <tr>
                            <td>
                            <td><?= $file; ?>
                            <td><?= PhpCode::hasUnicode($content) ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= PhpCode::hasDeprecatedFunction($content) ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= File::changed(__DIR__ . '/../../../../Model/' . $file)->format('Y-m-d'); ?>
                            <td>
                                <?= \phpOMS\Security\PhpCode::validateStringIntegrity(
                                    $content,
                                    Rest::request(
                                        new Request(
                                            new Http('https://raw.githubusercontent.com/Orange-Management/Model/develop/' . $file)
                                        )
                                    )->getBody()
                                ) ? $this->getHtml('OK') : $this->getHtml('NG'); ?>
                        <?php endforeach; ?>
                        <?php
                        $files = Directory::listByExtension(__DIR__ . '/../../../../Modules/', 'php', 'tests(\/|\\\)');
                        foreach ($files as $file) : $content = \file_get_contents(__DIR__ . '/../../../../Modules/' . $file); ?>
                        <tr>
                            <td>
                            <td><?= $file; ?>
                            <td><?= PhpCode::hasUnicode($content) ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= PhpCode::hasDeprecatedFunction($content) ? $this->getHtml('NG') : $this->getHtml('OK'); ?>
                            <td><?= File::changed(__DIR__ . '/../../../../Modules/' . $file)->format('Y-m-d'); ?>
                            <td>
                                <?= \phpOMS\Security\PhpCode::validateStringIntegrity(
                                    $content,
                                    Rest::request(
                                        new Request(
                                            new Http('https://raw.githubusercontent.com/Orange-Management/Modules/develop/' . $file)
                                        )
                                    )->getBody()
                                ) ? $this->getHtml('OK') : $this->getHtml('NG'); ?>
                        <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
