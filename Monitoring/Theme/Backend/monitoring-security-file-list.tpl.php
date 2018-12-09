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

use phpOMS\Message\Http\Request;
use phpOMS\Message\Http\Rest;
use phpOMS\Uri\Http;

/**
 * @var \phpOMS\Views\View $this
 */

$files = \phpOMS\System\File\Local\Directory(__DIR__ . '/../../../../phpOMS', '^.+\.php$');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="box col-xs-12 wf-100">
        <table class="table red">
            <caption><?= $this->getHtml('Files') ?></caption>
            <thead>
            <tr>
                <td class="wf-100"><?= $this->getHtml('File') ?>
                <td><?= $this->getHtml('Unicode') ?>
                <td><?= $this->getHtml('Deprecated') ?>
                <td><?= $this->getHtml('Integrity') ?>
                    <tbody>
                    <?php foreach ($files as $key => $file) : $source = \file_get_contents($file); ?>
            <tr>
                <td><?= $file; ?>
                <td><?= \phpOMS\Security\PhpCode::hasUnicode($source); ?>
                <td><?= \phpOMS\Security\PhpCode::hasDeprecatedFunction($source); ?>
                <td><?= \phpOMS\Security\PhpCode::validateFileIntegrity($file, \md5(Rest::request(new Request(new Http('https://raw.githubusercontent.com/Orange-Management/phpOMS/develop/Account/Account.php'))))); ?>
                    <?php endforeach; ?>
        </table>
    </div>
</div>
