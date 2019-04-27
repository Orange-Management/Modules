<?php declare(strict_types=1);
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

 /**
 * @var \phpOMS\Views\View $this
 */
$interfaces = $this->getData('interfaces');

echo $this->getData('nav')->render();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <table class="table darkred">
                <caption><?= $this->getHtml('Exports') ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                <tr>
                    <td class="wf-100"><?= $this->getHtml('Title') ?>
                <tbody>
                <?php $count = 0; foreach ($interfaces as $key => $value) : ++$count;
                $url = \phpOMS\Uri\UriFactory::build('{/prefix}admin/exchange/export/profile?{?}&id=' . $value->getId()); ?>
                    <tr data-href="<?= $url; ?>">
                        <td data-label="<?= $this->getHtml('Title') ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getName()); ?></a>
                <?php endforeach; ?>
                <?php if ($count === 0) : ?>
                    <tr><td colspan="2" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
