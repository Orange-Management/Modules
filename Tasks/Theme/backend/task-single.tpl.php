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
$task = new \Modules\Tasks\Models\Task(null);

echo $this->getData('nav')->render(); ?>
<div class="b b-3 c7-1 c7" id="i7-1-1">
    <div class="bc-1">
        <select>
            <option></option>
        </select>
    </div>
</div>

<div class="b b-3 c7-1 c7" id="i7-1-1">
    <h1>
        <?= $task->getTitle(); ?>
        <i class="fa fa-minus min"></i>
        <i class="fa fa-plus max vh"></i>
    </h1>

    <div class="bc-1">
        <span><?= $task->getCreated()->format('Y-m-d H:i:s'); ?></span>
        <span><?= $task->getDue()->format('Y-m-d H:i:s'); ?></span>
        <span><?= $task->getDone()->format('Y-m-d H:i:s'); ?></span> <span><?= $task->getStatus(); ?></span>
        <span><?= $task->getCreator(); ?></span>
        <?= $task->getDescription(); ?>
    </div>
</div>

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
$elements = $task->getTaskElements();
foreach ($elements as $element): ?>
    <div class="b b-3 c7-1 c7" id="i7-1-1">
        <div class="bc-1">
            <span><?= $element->getCreated()->format('Y-m-d H:i:s'); ?></span>
            <span><?= $element->getDue()->format('Y-m-d H:i:s'); ?></span> <span><?= $element->getStatus(); ?></span>
            <span><?= $element->getForwarded(); ?></span> <span><?= $element->getCreator(); ?></span>
            <?= $element->getDescription(); ?>
        </div>
    </div>
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
 */ endforeach; ?>

<div class="b b-3 c7-1 c7" id="i7-1-1">
    <div class="bc-1">
        <ul class="l-1">
            <li>
                <lable><?= $this->l11n->lang['Tasks']['Receiver']; ?></lable>
            <li><input type="text">
            <li>
                <lable><?= $this->l11n->lang['Tasks']['Due']; ?></lable>
            <li><input type="text">
            <li>
                <lable><?= $this->l11n->lang['Tasks']['Message']; ?></lable>
            <li><textarea style="width: 100%"></textarea>
        </ul>
        <button class="rf"><?= $this->l11n->lang[0]['Submit']; ?></button>
        <div class="clearfix"></div>
    </div>
</div>
