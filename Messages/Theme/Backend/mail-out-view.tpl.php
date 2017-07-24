<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
$mail = new \phpOMS\Message\Mail\Imap();
$mail->connect('{imap.gmail.com:993/imap/ssl}[Gmail]/Gesendet', 'dev.orange.management@gmail.com', DEV_PASSWORD);
$sent = $mail->getInboxAll();
$quota = $mail->getQuota();

echo $this->getData('nav')->render(); ?>

<section class="box w-100">
    <ul class="btns floatLeft">
        <li><a href="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/messages/mail/create'); ?>"><i class="fa fa-pencil"></i> <?{?}= $this->getHtml('Create', 0, 0); ?></a>
        <li><a href=""><i class="fa fa-trash"></i> <?= $this->getHtml('Delete') ?></a>
    </ul>
</section>

<div class="box w-100">
    <table class="table red">
        <caption><?= $this->getHtml('Messages') ?></caption>
        <thead>
        <tr>
            <td><span class="check"><input type="checkbox"></span>
            <td><?= $this->getHtml('Tag') ?>
            <td class="wf-100"><?= $this->getHtml('Subject') ?>
            <td><?= $this->getHtml('From') ?>
            <td><?= $this->getHtml('Date') ?>
        <tfoot>
        <tr><td colspan="5"><?= htmlspecialchars(\phpOMS\Utils\Converter\File::kilobyteSizeToString($quota['usage']), ENT_COMPAT, 'utf-8'); ?> / <?= htmlspecialchars(\phpOMS\Utils\Converter\File::kilobyteSizeToString($quota['limit']), ENT_COMPAT, 'utf-8'); ?>
        <tbody>
        <?php $count = 0; foreach($sent as $key => $value) : $count++;
        $url = \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/messages/mail/single?{?}&id=' . $value->uid); ?>
        <tr>
            <td><span class="check"><input type="checkbox"></span>
            <td><a href="<?= $url; ?>"<?= htmlspecialchars($value->seen == 0 ? ' class="unseen"' : '', ENT_COMPAT, 'utf-8'); ?>></a>
            <td><a href="<?= $url; ?>"<?= htmlspecialchars($value->seen == 0 ? ' class="unseen"' : '', ENT_COMPAT, 'utf-8'); ?>><?= htmlspecialchars(str_replace('_',' ', mb_decode_mimeheader($value->subject)), ENT_COMPAT, 'utf-8'); ?></a>
            <td><a href="<?= $url; ?>"<?= htmlspecialchars($value->seen == 0 ? ' class="unseen"' : '', ENT_COMPAT, 'utf-8'); ?>><?= htmlspecialchars($value->from, ENT_COMPAT, 'utf-8'); ?></a>
            <td><a href="<?= $url; ?>"<?= htmlspecialchars($value->seen == 0 ? ' class="unseen"' : '', ENT_COMPAT, 'utf-8'); ?>><?= htmlspecialchars((new \DateTime($value->date))->format('Y-m-d H:i:s'), ENT_COMPAT, 'utf-8'); ?></a>
                <?php endforeach; ?>
                <?php if($count < 1) : ?>
        <tr>
            <td colspan="5" class="empty"><?= $this->getHtml('Empty', 0, 0); ?>
                <?php endif; ?>
    </table>
</div>
