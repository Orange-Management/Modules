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
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
$mail = new \phpOMS\Message\Mail\Imap();
$mail->connect('{imap.gmail.com:993/imap/ssl}INBOX', 'dev.orange.management@gmail.com', DEV_PASSWORD);
$unseen = $mail->getInboxUnseen();
$seen = $mail->getInboxSeen();
$quota = $mail->getQuota();

echo $this->getData('nav')->render(); ?>

<section class="box w-100">
    <ul class="btns floatLeft">
        <li><a href="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/backend/messages/mail/create'); ?>"><i class="fa fa-pencil"></i> <?= $this->getText('Create', 0, 0); ?></a>
        <li><a href=""><i class="fa fa-trash"></i> <?= $this->getText('Delete'); ?></a>
    </ul>
</section>

<div class="box w-100">
    <table class="table">
        <caption><?= $this->getText('Messages'); ?></caption>
        <thead>
        <tr>
            <td><span class="check"><input type="checkbox"></span>
            <td><?= $this->getText('Tag'); ?>
            <td class="wf-100"><?= $this->getText('Subject'); ?>
            <td><?= $this->getText('From'); ?>
            <td><?= $this->getText('Date'); ?>
        <tfoot>
        <tr><td colspan="5"><?= \phpOMS\Utils\Converter\File::kilobyteSizeToString($quota['usage']); ?> / <?= \phpOMS\Utils\Converter\File::kilobyteSizeToString($quota['limit']); ?>
        <tbody>
            <?php $count = 0; foreach($unseen as $key => $value) : $count++;
            $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/messages/mail/single?id=' . $value->uid); ?>
            <tr>
                <td><span class="check"><input type="checkbox"></span>
                <td><a href="<?= $url; ?>"<?= $value->seen == 0 ? ' class="unseen"' : ''; ?>></a>
                <td><a href="<?= $url; ?>"<?= $value->seen == 0 ? ' class="unseen"' : ''; ?>><?= str_replace('_',' ', mb_decode_mimeheader($value->subject)); ?></a>
                <td><a href="<?= $url; ?>"<?= $value->seen == 0 ? ' class="unseen"' : ''; ?>><?= $value->from; ?></a>
                <td><a href="<?= $url; ?>"<?= $value->seen == 0 ? ' class="unseen"' : ''; ?>><?= (new \DateTime($value->date))->format('Y-m-d H:i:s'); ?></a>
            <?php endforeach; ?>

                    <?php foreach($seen as $key => $value) : $count++;
                    $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/messages/mail/single?id=' . $value->uid); ?>
            <tr>
                <td><span class="check"><input type="checkbox"></span>
                <td><a href="<?= $url; ?>"<?= $value->seen == 0 ? ' class="unseen"' : ''; ?>></a>
                <td><a href="<?= $url; ?>"<?= $value->seen == 0 ? ' class="unseen"' : ''; ?>><?= str_replace('_',' ', mb_decode_mimeheader($value->subject)); ?></a>
                <td><a href="<?= $url; ?>"<?= $value->seen == 0 ? ' class="unseen"' : ''; ?>><?= $value->from; ?></a>
                <td><a href="<?= $url; ?>"<?= $value->seen == 0 ? ' class="unseen"' : ''; ?>><?= (new \DateTime($value->date))->format('Y-m-d H:i:s'); ?></a>
                    <?php endforeach; ?>
            <?php if($count < 1) : ?>
        <tr>
            <td colspan="5" class="empty"><?= $this->getText('Empty', 0, 0); ?>
        <?php endif; ?>
    </table>
</div>
