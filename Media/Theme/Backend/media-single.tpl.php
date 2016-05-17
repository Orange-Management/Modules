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
/**
 * @var \phpOMS\Views\View $this
 */
$media = $this->getData('media');
echo $this->getData('nav')->render();
?>

<section class="box w-100">
    <header><h1><?= $media->getName() ?></h1></header>
    <div class="inner">
        <?php if(in_array($media->getExtension(), ['gif', 'bmp', 'jpg', 'jpeg', 'png'])) : ?>
            <img src="<?= $media->getPath(); ?>">
        <?php else : ?>
            <pre><?= htmlspecialchars(file_get_contents(ROOT_PATH . '/' . $media->getPath())); ?></pre>
        <?php endif; ?>
    </div>
</section>
