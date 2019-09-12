<?php declare(strict_types=1);
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   TBD
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
$department = $this->getData('department');
echo $this->getData('nav')->render(); ?>

<div class="tabview tab-2">
    <div class="box">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->getHtml('Department'); ?></label>
            <li><label for="c-tab-2"><?= $this->getHtml('Risks'); ?></label>
            <li><label for="c-tab-3"><?= $this->getHtml('Categories'); ?></label>
            <li><label for="c-tab-4"><?= $this->getHtml('Projects'); ?></label>
            <li><label for="c-tab-5"><?= $this->getHtml('Processes'); ?></label>
            <li><label for="c-tab-6"><?= $this->getHtml('Causes'); ?></label>
            <li><label for="c-tab-7"><?= $this->getHtml('Solutions'); ?></label>
        </ul>
    </div>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2" checked>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <section class="box wf-100">
                        <header><h1><?= $this->getHtml('Department') ?></h1></header>

                        <div class="inner">
                            <form id="fRisk"  method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/api}controlling/riskmanagement?{?}&csrf={$CSRF}'); ?>">
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><?= $this->getHtml('Name') ?></label><td><?= $this->printHtml($department->getDepartment()->getName()); ?>
                                    <tr><td><?= $this->getHtml('Description') ?>:<td><?= $this->printHtml($department->getDepartment()->getDescription()); ?>
                                    <tr><td><?= $this->getHtml('Unit') ?>:<td><?= $this->printHtml($department->getDepartment()->getUnit()->getName()); ?>
                                    <tr><td><?= $this->getHtml('Risks') ?>:<td>
                                    <tr><td><?= $this->getHtml('Categories') ?>:<td>
                                    <tr><td><?= $this->getHtml('Projects') ?>:<td>
                                    <tr><td><?= $this->getHtml('Processes') ?>:<td>
                                    <tr><td><?= $this->getHtml('Causes') ?>:<td>
                                    <tr><td><?= $this->getHtml('Solutions') ?>:<td>
                                </table>
                            </form>
                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-md-6">
                    <section class="box wf-100">
                        <header><h1><?= $this->getHtml('Media') ?></h1></header>

                        <div class="inner">
                            <form>
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td colspan="2"><label for="iMedia"><?= $this->getHtml('Media') ?></label>
                                    <tr><td><input type="text" id="iMedia" placeholder="&#xf15b; File"><td><button><?= $this->getHtml('Select') ?></button>
                                    <tr><td colspan="2"><label for="iUpload"><?= $this->getHtml('Upload') ?></label>
                                    <tr><td><input type="file" id="iUpload" form="fTask"><input form="fTask" type="hidden" name="type"><td>
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <section class="box wf-100">
                        <header><h1><?= $this->getHtml('Responsibility') ?></h1></header>

                        <div class="inner">
                            <form>
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><label for="iResponsibility"><?= $this->getHtml('Responsibility') ?></label><td><label for="iUser"><?= $this->getHtml('UserGroup') ?></label><td>
                                    <tr><td><select id="iStatus" name="status">
                                                <option value="">
                                            </select>
                                        <td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="iUser" name="user" placeholder=""></span><td><button><?= $this->getHtml('Add', '0', '0'); ?></button>
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <input type="radio" id="c-tab-2" name="tabular-2">
        <div class="tab">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box wf-100">
                        <table class="default">
                            <caption><?= $this->getHtml('Risks') ?><i class="fa fa-download floatRight download btn"></i></caption>
                            <thead>
                            <tr>
                                <td><?= $this->getHtml('ID', '0', '0'); ?>
                                <td class="wf-100"><?= $this->getHtml('Title') ?>
                                <td><?= $this->getHtml('Causes') ?>
                                <td><?= $this->getHtml('Solutions') ?>
                                <td><?= $this->getHtml('RiskObjects') ?>
                                    <tfoot>
                            <tr><td colspan="5">
                                    <tbody>
                                    <?php $c = 0; foreach ($risks as $key => $value) : ++$c;
                                    $url = \phpOMS\Uri\UriFactory::build('{/prefix}riskmanagement/cause/single?{?}&id=' . $value->getId()); ?>
                            <tr data-href="<?= $url; ?>">
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getId()); ?></a>
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getName()); ?></a>
                                <td><a href="<?= $url; ?>"><?= $this->printHtml(\count($value->getCauses())); ?></a>
                                <td><a href="<?= $url; ?>"><?= $this->printHtml(\count($value->getSolutions())); ?></a>
                                <td><a href="<?= $url; ?>"><?= $this->printHtml(\count($value->getRiskObjects())); ?></a>
                                    <?php endforeach; ?>
                                    <?php if ($c === 0) : ?>
                                    <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <input type="radio" id="c-tab-3" name="tabular-2">
        <div class="tab">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box wf-100">
                        <table class="default">
                            <caption><?= $this->getHtml('Categories') ?><i class="fa fa-download floatRight download btn"></i></caption>
                            <thead>
                            <tr>
                                <td><?= $this->getHtml('ID', '0', '0'); ?>
                                <td class="wf-100"><?= $this->getHtml('Title') ?>
                                    <tfoot>
                            <tr><td colspan="3">
                                    <tbody>
                                    <?php $c = 0; foreach ($categories as $key => $value) : ++$c;
                                    $url = \phpOMS\Uri\UriFactory::build('{/prefix}riskmanagement/category/single?{?}&id=' . $value->getId()); ?>
                            <tr data-href="<?= $url; ?>">
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getId()); ?></a>
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getTitle()); ?></a>
                                    <?php endforeach; ?>
                                    <?php if ($c === 0) : ?>
                                    <tr><td colspan="3" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <input type="radio" id="c-tab-4" name="tabular-2">
        <div class="tab">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box wf-100">
                        <table class="default">
                            <caption><?= $this->getHtml('Projects') ?><i class="fa fa-download floatRight download btn"></i></caption>
                            <thead>
                            <tr>
                                <td><?= $this->getHtml('ID', '0', '0'); ?>
                                <td class="wf-100"><?= $this->getHtml('Title') ?>
                                    <tfoot>
                            <tr><td colspan="3">
                                    <tbody>
                                    <?php $c = 0; foreach ($projects as $key => $value) : ++$c;
                                    $url = \phpOMS\Uri\UriFactory::build('{/prefix}riskmanagement/project/single?{?}&id=' . $value->getId()); ?>
                            <tr data-href="<?= $url; ?>">
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getId()); ?></a>
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getProject()->getName()); ?></a>
                                    <?php endforeach; ?>
                                    <?php if ($c === 0) : ?>
                                    <tr><td colspan="3" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <input type="radio" id="c-tab-5" name="tabular-2">
        <div class="tab">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box wf-100">
                        <table class="default">
                            <caption><?= $this->getHtml('Processes') ?><i class="fa fa-download floatRight download btn"></i></caption>
                            <thead>
                            <tr>
                                <td><?= $this->getHtml('ID', '0', '0'); ?>
                                <td class="wf-100"><?= $this->getHtml('Title') ?>
                                    <tfoot>
                            <tr><td colspan="3">
                                    <tbody>
                                    <?php $c = 0; foreach ($processes as $key => $value) : ++$c;
                                    $url = \phpOMS\Uri\UriFactory::build('{/prefix}riskmanagement/process/single?{?}&id=' . $value->getId()); ?>
                            <tr data-href="<?= $url; ?>">
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getId()); ?></a>
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getTitle()); ?></a>
                                    <?php endforeach; ?>
                                    <?php if ($c === 0) : ?>
                                    <tr><td colspan="3" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <input type="radio" id="c-tab-6" name="tabular-2">
        <div class="tab">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box wf-100">
                        <table class="default">
                            <caption><?= $this->getHtml('Causes') ?><i class="fa fa-download floatRight download btn"></i></caption>
                            <thead>
                            <tr>
                                <td><?= $this->getHtml('ID', '0', '0'); ?>
                                <td class="wf-100"><?= $this->getHtml('Title') ?>
                                <td><?= $this->getHtml('Risk') ?>
                                    <tfoot>
                            <tr><td colspan="3">
                                    <tbody>
                                    <?php $c = 0; foreach ($causes as $key => $value) : ++$c;
                                    $url = \phpOMS\Uri\UriFactory::build('{/prefix}riskmanagement/cause/single?{?}&id=' . $value->getId()); ?>
                            <tr data-href="<?= $url; ?>">
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getId()); ?></a>
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getTitle()); ?></a>
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getRisk()->getName()); ?></a>
                                    <?php endforeach; ?>
                                    <?php if ($c === 0) : ?>
                                    <tr><td colspan="3" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <input type="radio" id="c-tab-7" name="tabular-2">
        <div class="tab">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box wf-100">
                        <table class="default">
                            <caption><?= $this->getHtml('Solutions') ?><i class="fa fa-download floatRight download btn"></i></caption>
                            <thead>
                            <tr>
                                <td><?= $this->getHtml('ID', '0', '0'); ?>
                                <td class="wf-100"><?= $this->getHtml('Title') ?>
                                <td><?= $this->getHtml('Risk') ?>
                                <td><?= $this->getHtml('Cause') ?>
                                    <tfoot>
                            <tr><td colspan="4">
                                    <tbody>
                                    <?php $c = 0; foreach ($solutions as $key => $value) : ++$c;
                                    $url = \phpOMS\Uri\UriFactory::build('{/prefix}riskmanagement/solution/single?{?}&id=' . $value->getId()); ?>
                            <tr data-href="<?= $url; ?>">
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getId()); ?></a>
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getTitle()); ?></a>
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getRisk()->getName()); ?></a>
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getCause()->getTitle()); ?></a>
                                    <?php endforeach; ?>
                                    <?php if ($c === 0) : ?>
                                    <tr><td colspan="4" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>