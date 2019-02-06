<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */

use \phpOMS\System\File\FileUtils;
use \phpOMS\System\File\Local\File;
use \phpOMS\Uri\UriFactory;

include __DIR__ . '/template-functions.php';

/**
 * @var \phpOMS\Views\View $this
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
                        <tr><td><?= $this->getHtml('Name') ?><td class="wf-100"><?= $this->printHtml($media->getName()); ?>
                        <tr><td><?= $this->getHtml('Size') ?><td class="wf-100"><?= $this->printHtml($media->getSize()); ?>
                        <tr><td><?= $this->getHtml('Created') ?><td><?= $this->printHtml($media->getCreatedAt()->format('Y-m-d')); ?>
                        <tr><td><?= $this->getHtml('Creator') ?><td><?= $this->printHtml($media->getCreatedBy()->getName1()); ?>
                        <tr><td><?= $this->getHtml('Description') ?><td><?= $this->printHtml($media->getDescription()); ?>
                </table>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <?php if ($this->isCollectionFunction($media, $this->request->getData('sub') ?? '')) : ?>
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table darkred">
                <caption><?= $this->getHtml('Media') ?></caption>
                <thead>
                <tr>
                    <td>
                    <td class="wf-100"><?= $this->getHtml('Name') ?>
                    <td><?= $this->getHtml('Type') ?>
                    <td><?= $this->getHtml('Size') ?>
                    <td><?= $this->getHtml('Creator') ?>
                    <td><?= $this->getHtml('Created') ?>
                <tbody>
                    <?php
                        if (!\is_dir($media->isAbsolute() ? $path : __DIR__ . '/../../../' . \ltrim($media->getPath(), '//'))
                            || $media->getPath() === ''
                        ) :
                            foreach ($media as $key => $value) :
                                $url  = UriFactory::build('/{/lang}/backend/media/single?{?}&id=' . $value->getId());
                                $icon = $fileIconFunction(FileUtils::getExtensionType($value->getExtension()));
                        ?>
                        <tr data-href="<?= $url; ?>">
                            <td><a href="<?= $url; ?>"><i class="fa fa-<?= $this->printHtml($icon); ?>"></i></a>
                            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getName()); ?></a>
                            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getExtension()); ?></a>
                            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getSize()); ?></a>
                            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getCreatedBy()->getName1()); ?></a>
                            <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getCreatedAt()->format('Y-m-d H:i:s')); ?></a>
                    <?php endforeach; else : $path = $this->dirPathFunction($media, $this->request->getData('sub') ?? ''); ?>
                        <?php $list = \phpOMS\System\File\Local\Directory::list($path);
                            foreach ($list as $key => $value) :
                                $url = UriFactory::build('/{/lang}/backend/media/single?{?}&id=' . $media->getId() . '&sub=' . \substr($value, \strlen($media->getPath())));
                                $icon = $this->fileIconFunction(FileUtils::getExtensionType(!\is_dir($value) ? File::extension($value) : 'collection'));
                        ?>
                        <tr data-href="<?= $url; ?>">
                            <td><a href="<?= $url; ?>"><i class="fa fa-<?= $this->printHtml($icon); ?>"></i></a>
                            <td><a href="<?= $url; ?>"><?= \substr($value, \strlen($media->getPath())); ?></a>
                            <td><a href="<?= $url; ?>"><?= !\is_dir($value) ? File::extension($value) : 'collection'; ?></a>
                            <td><a href="<?= $url; ?>"><?= !\is_dir($value) ? File::size($value) : ''; ?></a>
                            <td><a href="<?= $url; ?>"><?= File::owner($value); ?></a>
                            <td><a href="<?= $url; ?>"><?= File::created($value)->format('Y-m-d'); ?></a>
                    <?php endforeach; endif; ?>
            </table>
        </div>
    </div>
    <?php else: ?>
    <div class="col-xs-12">
        <section class="box wf-100">
            <div class="inner">
                <?php
                $path = $this->filePathFunction($media, $this->request->getData('sub') ?? '');

                if ($this->isImageFunction($media, $path)) : ?>
                    <div class="h-overflow">
                        <img src="<?= $media->isAbsolute() ? $this->printHtml($path) : $this->printHtml($this->request->getUri()->getBase() . $path); ?>">
                    </div>
                <?php else : ?>
                    <button class="floatRight">Edit</button>

                    <?php if (!\file_exists($media->isAbsolute() ? $path : __DIR__ . '/../../../' . \ltrim($path, '/'))) : ?>
                        <div class="centerText"><i class="fa fa-question fa-5x"></i></div>
                    <?php else : ?>
                    <pre>
                    <?php
                    $output = $this->lineContentFunction($media->isAbsolute() ? $path : __DIR__ . '/../../../' . \ltrim($path, '/'));
                    foreach ($output as $line) : ?><span><?= $this->printHtml($line); ?></span><?php endforeach; ?>
                    </pre>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </section>
    </div>
    <?php endif; ?>
</div>