<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
/** @noinspection PhpUndefinedMethodInspection */
\phpOMS\Module\ModuleFactory::$loaded['Navigation']->call([\Modules\Navigation\Models\NavigationType::CONTENT,
                                                           1000401001,]);
?>

<div class="b b-3 c4-2 c4" id="i4-2-1">
    <h1>
        <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Media']['Preview']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
    </div>
</div>

<div class="b b-1 c4-2 c4" id="i4-2-2">
    <h1>
        <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Media']['Data']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <!-- @formatter:off -->
        <table class="tc-1">
            <tr>
                <th><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Media']['Name']; ?></label>
                <td><?= $media->getName(); ?>
            <tr>
                <th><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Media']['Extension']; ?></label>
                <td><?= $media->getExtension(); ?>
            <tr>
                <th><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Media']['Size']; ?></label>
                <td><?= \phpOMS\Utils\Converter\File::byteSizeToString($media->getSize()); ?>
            <tr>
                <th><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Media']['Author']; ?></label>
                <td><?= $media->getAuthor(); ?>
            <tr>
                <th><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Media']['Created']; ?></label>
                <td><?= $media->getCreated()->format('Y-m-d H:i:s'); ?>
            <tr>
                <th><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Media']['Changed']; ?></label>
                <td>asldkf
            <tr>
                <th><label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Media']['Changedby']; ?></label>
                <td>asldkf
        </table>
        <!-- @formatter:on -->
    </div>
</div>


<div class="b b-1 c4-2 c4" id="i4-2-2">
    <h1>
        <?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Media']['Settings']; ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <ul class="l-1">
            <li>
                <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Media']['Visibility']; ?></label>
            <li><input type="text">
                <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?></button>
            <li>
                <label><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang['Media']['Editability']; ?></label>
            <li><input type="text">
                <button><?= $this->app->accountManager->get($request->getAccount())->getL11n()->lang[0]['Add']; ?>
        </ul>
    </div>
</div>
