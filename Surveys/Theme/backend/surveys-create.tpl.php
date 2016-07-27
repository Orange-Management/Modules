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
echo $this->getData('nav')->render(); ?>

<section class="box w-50 floatLeft">
    <header><h1><?= $this->getText('Survey') ?></h1></header>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td colspan="3"><label for="iName"><?= $this->getText('Name') ?><label>
                <tr><td colspan="2"><input type="text" id="iName" name="name" required><td>
                <tr><td><label for="iStart"><?= $this->getText('Start') ?><label><td><label for="iEnd"><?= $this->getText('End') ?><label><td>
                <tr><td><input type="datetime-local" id="iStart" name="start" required><td><input type="datetime-local" id="iEnd" name="end" required><td>
                <tr><td colspan="3"><label for="iDesc"><?= $this->getText('Description') ?><label>
                <tr><td colspan="2"><textarea id="iDesc" name="desc"></textarea><td>
                <tr><td colspan="3"><span class="check"><input type="checkbox" id="iResult" name="result"><label for="iResult"><?= $this->getText('ResultPublic') ?><label></span>
                <tr><td><label for="iResponsibility"><?= $this->getText('Responsibility') ?><label><td colspan="2"><label for="iPerm"><?= $this->getText('UserGroup') ?><label>
                <tr><td><select id="iResponsibility" name="responsibility">
                        <option value=""><?= $this->getText('Questionee') ?>
                        <option value=""><?= $this->getText('Manager') ?>
                    </select><td><span class="input"><button type="button" formaction=""><i class="fa fa-book"></i></button><input type="text" id="iPerm" name="permission"></span><td><button><?= $this->getText('Add', 0, 0) ?></button>
                <tr><td colspan="3"><input type="submit" value="<?= $this->getText('Create', 0, 0); ?>">
            </table>
        </form>
    </div>
</section>

<section class="box w-50 floatLeft">
    <header><h1><?= $this->getText('Section') ?></h1></header>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td colspan="2"><label for="iSection"><?= $this->getText('Section') ?><label>
                <tr><td colspan="2"><input type="text" id="iSection" name="section">
                <tr><td colspan="2"><label for="iSDesc"><?= $this->getText('Description') ?><label>
                <tr><td colspan="2"><textarea id="iSDesc" name="sdesc"></textarea>
                <tr><td colspan="2"><label for="iSType"><?= $this->getText('Type') ?><label>
                <tr><td colspan="2"><select id="iSType" name="stype">
                            <option>
                        </select>
                <tr><td colspan="2"><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
            </table>
        </form>
    </div>
</section>


<section class="box w-50 floatLeft">
    <header><h1><?= $this->getText('Question') ?></h1></header>
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td colspan="2"><label for="iQuestion"><?= $this->getText('Question') ?><label>
                <tr><td colspan="2"><input type="text" id="iQuestion" name="question">
                <tr><td colspan="2"><label for="iQDesc"><?= $this->getText('Description') ?><label>
                <tr><td colspan="2"><textarea id="iQDesc" name="qdesc"></textarea>
                <tr><td colspan="2"><label for="iQSection"><?= $this->getText('Section') ?><label>
                <tr><td colspan="2"><select id="iQSection" name="iqsection">
                                            <option>
                                    </select>
                <tr><td colspan="2"><input type="submit" value="<?= $this->getText('Add', 0, 0) ?>">
            </table>
        </form>
    </div>
</section>
