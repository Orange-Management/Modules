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
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
$mail = new \phpOMS\Message\Mail\Imap();
$mail->connect('{imap.gmail.com:993/imap/ssl}', 'dev.orange.management@gmail.com', DEV_PASSWORD);
$boxes = $mail->getBoxes();

echo $this->getData('nav')->render(); ?>

<section class="box w-33">
    <header><h1><?= $this->getText('Mailboxes'); ?></h1></header>
    <div class="inner">
        <form>
            <table class="layout">
                <tr><td><label for="iInbox"><?= $this->getText('Inbox'); ?></label>
                <tr><td><select id="iInbox" name="inbox">
                            <option value=""><?= $this->getText('Select'); ?>
                            <?php foreach($boxes as $box) : ?>
                            <option value="<?= $box; ?>"><?= $box; ?>
                            <?php endforeach; ?>
                        </select>
                <tr><td><label for="iOutbox"><?= $this->getText('Outbox'); ?></label>
                <tr><td><select id="iOutbox" name="outbox">
                            <option value=""><?= $this->getText('Select'); ?>
                            <?php foreach($boxes as $box) : ?>
                            <option value="<?= $box; ?>"><?= $box; ?>
                                <?php endforeach; ?>
                        </select>
                <tr><td><label for="iDraft"><?= $this->getText('Draft'); ?></label>
                <tr><td><select id="iDraft" name="draft">
                            <option value=""><?= $this->getText('Select'); ?>
                            <?php foreach($boxes as $box) : ?>
                            <option value="<?= $box; ?>"><?= $box; ?>
                                <?php endforeach; ?>
                        </select>
                <tr><td><label for="iTrash"><?= $this->getText('Trash'); ?></label>
                <tr><td><select id="iTrash" name="trash">
                            <option value=""><?= $this->getText('Select'); ?>
                            <?php foreach($boxes as $box) : ?>
                            <option value="<?= $box; ?>"><?= $box; ?>
                                <?php endforeach; ?>
                        </select>
                <tr><td><label for="iSpam"><?= $this->getText('Spam'); ?></label>
                <tr><td><select id="iSpam" name="spam">
                            <option value=""><?= $this->getText('Select'); ?>
                            <?php foreach($boxes as $box) : ?>
                            <option value="<?= $box; ?>"><?= $box; ?>
                                <?php endforeach; ?>
                        </select>
                <tr><td><input type="submit" value="<?= $this->getText('Save'); ?>">
            </table>
        </form>
    </div>
</section>
