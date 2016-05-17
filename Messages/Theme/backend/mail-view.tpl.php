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
$mail->connect('{imap.gmail.com:993/imap/ssl}INBOX', 'dev.orange.management@gmail.com', DEV_PASSWORD);
$mails = $mail->getEmail($this->getData('id'));

echo $this->getData('nav')->render(); ?>

<section class="box w-100">
    <header><h1><?= str_replace('_',' ', mb_decode_mimeheader($mails['overview'][0]->subject)); ?></h1></header>
    <div class="inner">
        <?= $mail::decode($mails['body'], $mails['encoding']->encoding); ?>
    </div>
</section>
