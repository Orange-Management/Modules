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
            <header><h1><?= htmlspecialchars($media->getName() , ENT_COMPAT, 'utf-8'); ?></h1></header>
            <div class="inner">
                <table class="list w-100">
                    <tbody>
                        <tr><td>Size<td class="wf-100"><?= htmlspecialchars($media->getSize(), ENT_COMPAT, 'utf-8'); ?>
                        <tr><td>Created at<td><?= htmlspecialchars($media->getCreatedAt()->format('Y-m-d'), ENT_COMPAT, 'utf-8'); ?>
                        <tr><td>Created by<td><?= htmlspecialchars($media->getCreatedBy(), ENT_COMPAT, 'utf-8'); ?>
                        <tr><td>Description<td><?= htmlspecialchars($media->getDescription(), ENT_COMPAT, 'utf-8'); ?>
                        <tr><td colspan="2">Content
                </table>
                <?php if(\phpOMS\System\File\FileUtils::getExtensionType($media->getExtension()) === \phpOMS\System\File\ExtensionType::IMAGE) : ?>
                    <div class="h-overflow"><img src="<?= htmlspecialchars($this->request->getUri()->getBase() . $media->getPath(), ENT_COMPAT, 'utf-8'); ?>"></div>
                <?php elseif($media->getExtension() === 'collection') : ?>
                    collection
                <?php else : ?>
                    <pre>
                    <?php
                    $output = htmlspecialchars(file_get_contents(__DIR__ . '/../../../../' . $media->getPath()));
                    $output = str_replace(["\r\n", "\r"], "\n", $output);
                    $output = explode("\n", $output);
                    foreach($output as $line) : ?><span><?= htmlspecialchars($line, ENT_COMPAT, 'utf-8'); ?></span><?php endforeach; ?>
                    </pre>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>