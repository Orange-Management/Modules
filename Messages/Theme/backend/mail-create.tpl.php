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

<section class="box w-100">
    <div class="inner">
        <form>
            <table class="layout wf-100">
                <tr><td style="width: 1%"><button class="simple"><i class="fa fa-book"></i></button><td><input type="text" placeholder="&#xf007; <?= $this->getText('To'); ?>" name="to">
                <tr><td style="width: 1%"><button class="simple"><i class="fa fa-book"></i></button><td><input type="text" placeholder="&#xf007; <?= $this->getText('CC'); ?>" name="cc">
                <tr><td style="width: 1%"><button class="simple"><i class="fa fa-book"></i></button><td><input type="text" placeholder="&#xf007; <?= $this->getText('BCC'); ?>" name="bcc">
                <tr><td><td><input type="text" placeholder="&#xf040; <?= $this->getText('Subject'); ?>" name="subject">
                <tr><td><td><input type="file" name="files" multiple>
                <tr><td><td><div class="textarea" contenteditable="true" style="height: 400px;"></div><textarea placeholder="&#xf040;" style="display: none" name="mail"></textarea>
                <tr><td><td><input type="submit" value="<?= $this->getText(0]['Send']; ?>"> <input type="submit" value="<?= $this->l11n->lang[0, 'Backend', 'Save'); ?>">
            </table>
        </form>
    </div>
</section>
