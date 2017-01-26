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
/**
 * @var $media \Modules\Media\Models\Media
 */
$media = $this->getData('media');
echo $this->getData('nav')->render();
?>

<section class="box w-100">
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
        <?php if(in_array($media->getExtension(), ['gif', 'bmp', 'jpg', 'jpeg', 'png'])) : ?>
            <img src="<?= $this->request->getUri()->getBase() . $media->getPath(); ?>">
        <?php elseif($media->getExtension() === 'collection') : ?>
            collection
        <?php else : ?>
            <pre>
            <?php
            $output = htmlspecialchars(file_get_contents(ROOT_PATH . '/' . $media->getPath()));
            $output = str_replace(["\r\n", "\r"], "\n", $output);
            $output = explode("\n", $output);
            foreach($output as $line) : ?><span><?= $line; ?></span><?php endforeach; ?>
            </pre>
        <?php endif; ?>
    </div>
</section>
