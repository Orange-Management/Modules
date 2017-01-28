<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
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
/**
 * @var \phpOMS\Views\View $this
 */
echo $this->getData('nav')->render(); 
$system = \phpOMS\System\OperatingSystem::getSystem();
?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getText('Job'); ?></h1></header>

            <div class="inner">
                <form id="fJob"  method="POST" action="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/api/job?csrf={$CSRF}'); ?>">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td><label for="iName"><?= $this->getText('Name'); ?></label>
                        <tr><td><input type="text" id="iName" name="name">
                        <tr><td><label for="iCmd"><?= $this->getText('Command'); ?></label>
                        <tr><td><textarea id="iCmd" name="command"></textarea>
                        <tr><td><label for="iType"><?= $this->getText('Type'); ?></label>
                        <tr><td><input type="text" id="iType" name="type" value="<?= $system === \phpOMS\System\SystemType::WIN ? 'Schtasks' : ($system === \phpOMS\System\SystemType::LINUX ? 'Cron' : 'Launchd'); ?>" disabled>
                        <tr><td><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>">
                    </table>
                </form>
            </div>
        </section>
    </div>
</div>