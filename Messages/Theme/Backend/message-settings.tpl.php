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
$mail = new \phpOMS\Message\Mail\Imap();
$mail->connect('{imap.gmail.com:993/imap/ssl}', 'dev.orange.management@gmail.com', DEV_PASSWORD);
$boxes = $mail->getBoxes();

echo $this->getData('nav')->render(); ?>

<section class="box w-33">
    <h1><?= $this->l11n->lang['Messages']['Mailboxes']; ?></h1>
    <div class="inner">
        <form>
            <table class="layout">
                <tr><td><label for="iInbox"><?= $this->l11n->lang['Messages']['Inbox']; ?></label>
                <tr><td><select id="iInbox" name="inbox">
                            <option value=""><?= $this->l11n->lang[0]['Select']; ?>
                            <?php foreach($boxes as $box) : ?>
                            <option value="<?= $box; ?>"><?= $box; ?>
                            <?php endforeach; ?>
                        </select>
                <tr><td><label for="iOutbox"><?= $this->l11n->lang['Messages']['Outbox']; ?></label>
                <tr><td><select id="iOutbox" name="outbox">
                            <option value=""><?= $this->l11n->lang[0]['Select']; ?>
                            <?php foreach($boxes as $box) : ?>
                            <option value="<?= $box; ?>"><?= $box; ?>
                                <?php endforeach; ?>
                        </select>
                <tr><td><label for="iDraft"><?= $this->l11n->lang['Messages']['Draft']; ?></label>
                <tr><td><select id="iDraft" name="draft">
                            <option value=""><?= $this->l11n->lang[0]['Select']; ?>
                            <?php foreach($boxes as $box) : ?>
                            <option value="<?= $box; ?>"><?= $box; ?>
                                <?php endforeach; ?>
                        </select>
                <tr><td><label for="iTrash"><?= $this->l11n->lang['Messages']['Trash']; ?></label>
                <tr><td><select id="iTrash" name="trash">
                            <option value=""><?= $this->l11n->lang[0]['Select']; ?>
                            <?php foreach($boxes as $box) : ?>
                            <option value="<?= $box; ?>"><?= $box; ?>
                                <?php endforeach; ?>
                        </select>
                <tr><td><label for="iSpam"><?= $this->l11n->lang['Messages']['Spam']; ?></label>
                <tr><td><select id="iSpam" name="spam">
                            <option value=""><?= $this->l11n->lang[0]['Select']; ?>
                            <?php foreach($boxes as $box) : ?>
                            <option value="<?= $box; ?>"><?= $box; ?>
                                <?php endforeach; ?>
                        </select>
                <tr><td><input type="submit" value="<?= $this->l11n->lang[0]['Save']; ?>">
            </table>
        </form>
    </div>
</section>
