<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
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
            <header><h1><?= $this->printHtml($media->getName()); ?></h1></header>
            <div class="inner">
                <table class="list w-100">
                    <tbody>
                        <tr><td>Name<td class="wf-100"><?= $this->printHtml($media->getName()); ?>
                        <tr><td>Size<td class="wf-100"><?= $this->printHtml($media->getSize()); ?>
                        <tr><td>Created at<td><?= $this->printHtml($media->getCreatedAt()->format('Y-m-d')); ?>
                        <tr><td>Created by<td><?= $this->printHtml($media->getCreatedBy()->getName1()); ?>
                        <tr><td>Description<td><?= $this->printHtml($media->getDescription()); ?>
                </table>
            </div>
        </section>
    </div>
    <div class="col-xs-12">
        <section class="box wf-100">
            <div class="inner">
                <?php if(\phpOMS\System\File\FileUtils::getExtensionType($media->getExtension()) === \phpOMS\System\File\ExtensionType::IMAGE) : ?>
                    <div class="h-overflow"><img src="<?= $this->printHtml($this->request->getUri()->getBase() . $media->getPath()); ?>"></div>
                <?php elseif($media->getExtension() === 'collection') : ?>
                    <ul>
                        <?php foreach($media as $file) : ?>
                            <li><a href="<?= \phpOMS\Uri\UriFactory::build('{/base}/{/lang}/backend/media/single?{?}&id=' . $file->getId()); ?>"><?= $this->printHtml($file->getName()); ?></a>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <pre>
                    <?php
                    $output = file_get_contents(__DIR__ . '/../../../../' . $media->getPath());
                    $output = str_replace(["\r\n", "\r"], "\n", $output);
                    $output = explode("\n", $output);
                    foreach($output as $line) : ?><span><?= $this->printHtml($line); ?></span><?php endforeach; ?>
                    </pre>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>