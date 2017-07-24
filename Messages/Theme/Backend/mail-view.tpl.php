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
$mail->connect('{imap.gmail.com:993/imap/ssl}INBOX', 'dev.orange.management@gmail.com', DEV_PASSWORD);
$mails = $mail->getEmail($this->getData('id'));

echo $this->getData('nav')->render(); ?>

<section class="box w-100">
    <header><h1><?= htmlspecialchars(str_replace('_',' ', mb_decode_mimeheader($mails['overview'][0]->subject)), ENT_COMPAT, 'utf-8'); ?></h1></header>
    <div class="inner">
        <?= htmlspecialchars($mail::decode($mails['body'], $mails['encoding']->encoding), ENT_COMPAT, 'utf-8'); ?>
    </div>
</section>
