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
/**
 * @var \phpOMS\Views\View $this
 */

$media      = $this->getData('media');
$footerView = new \Web\Views\Lists\PaginationView($this->app, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(count($media) / 25);
$footerView->setPage(1);

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table red">
                <caption><?= $this->getText('Media'); ?></caption>
                <thead>
                <tr>
                    <td>
                    <td class="wf-100"><?= $this->getText('Name'); ?>
                    <td><?= $this->getText('Type'); ?>
                    <td><?= $this->getText('Size'); ?>
                    <td><?= $this->getText('Creator'); ?>
                    <td><?= $this->getText('Created'); ?>
                        <tfoot>
                <tr>
                    <td colspan="3"><?= $footerView->render(); ?>
                        <tbody>
                        <?php $count = 0; foreach($media as $key => $value) : $count++;
                        $url = \phpOMS\Uri\UriFactory::build('/{/lang}/backend/media/single?{?}&id=' . $value->getId()); 

                        $icon = '';
                        $extensionType = \phpOMS\System\File\FileUtils::getExtensionType($value->getExtension());

                        if($extensionType === \phpOMS\System\File\ExtensionType::CODE) {
                            $icon = 'file-code-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::TEXT) {
                            $icon = 'file-text-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::PRESENTATION) {
                           $icon = 'file-powerpoint-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::PDF) {
                            $icon = 'file-pdf-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::ARCHIVE) {
                            $icon = 'file-zip-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::AUDIO) {
                            $icon = 'file-audio-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::VIDEO) {
                            $icon = 'file-video-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::IMAGE) {
                            $icon = 'file-image-o';
                        } elseif($extensionType === \phpOMS\System\File\ExtensionType::SPREADSHEET) {
                            $icon = 'file-excel-o';
                        } elseif($value->getExtension() === 'collection') {
                            $icon = 'folder-open-o';
                        } else {
                            $icon = 'file-o';
                        }
                        ?>
                        <tr>
                            <td><a href="<?= $url; ?>"><i class="fa fa-<?= $icon; ?>"></i></a>
                            <td><a href="<?= $url; ?>"><?= $value->getName(); ?></a>
                            <td><a href="<?= $url; ?>"><?= $value->getExtension(); ?></a>
                            <td><a href="<?= $url; ?>"><?= $value->getSize(); ?></a>
                            <td><a href="<?= $url; ?>"><?= $value->getCreatedBy(); ?></a>
                            <td><a href="<?= $url; ?>"><?= $value->getCreatedAt()->format('Y-m-d H:i:s'); ?></a>
                        <?php endforeach; ?>
                        <?php if($count === 0) : ?>
                <tr><td colspan="5" class="empty"><?= $this->getText('Empty', 0, 0); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>
</div>
