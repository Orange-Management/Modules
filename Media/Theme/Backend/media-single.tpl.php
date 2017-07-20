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
/**
 * @var \phpOMS\Views\View $this
 */
/**
 * @var $media \Modules\Media\Models\Media
 */
$media = $this->getData('media');
echo $this->getData('nav')->render();
?>

<div class="row">
    <div class="col-xs-12">
        <section class="box wf-100">
            <header><h1><?= $media->getName() ?></h1></header>
            <div class="inner">
                <table class="list w-100">
                    <tbody>
                        <tr><td>Size<td class="wf-100"><?= $media->getSize(); ?>
                        <tr><td>Created at<td><?= $media->getCreatedAt()->format('Y-m-d'); ?>
                        <tr><td>Created by<td><?= $media->getCreatedBy(); ?>
                        <tr><td>Description<td><?= $media->getDescription(); ?>
                        <tr><td colspan="2">Content
                </table>
                <?php if(\phpOMS\System\File\FileUtils::getExtensionType($media->getExtension()) === \phpOMS\System\File\ExtensionType::IMAGE) : ?>
                    <div class="h-overflow"><img src="<?= $this->request->getUri()->getBase() . $media->getPath(); ?>"></div>
                <?php elseif($media->getExtension() === 'collection') : ?>
                    collection
                <?php else : ?>
                    <pre>
                    <?php
                    $output = htmlspecialchars(file_get_contents(__DIR__ . '/../../../../' . $media->getPath()));
                    $output = str_replace(["\r\n", "\r"], "\n", $output);
                    $output = explode("\n", $output);
                    foreach($output as $line) : ?><span><?= $line; ?></span><?php endforeach; ?>
                    </pre>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>