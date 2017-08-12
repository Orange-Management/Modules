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

$doc = $this->getData('doc') ?? null;
?>
<div id="testEditor" class="m-editor">
    <section class="box wf-100">
        <div class="inner">
            <input type="text" name="title" form="docForm">
        </div>
    </section>

    <section class="box wf-100">
        <div class="inner">
            <?php include __DIR__ . '/inline-editor-tools.tpl.php'; ?>
        </div>
    </section>

    <div class="box wf-100">
        <?php include __DIR__ . '/inline-editor.tpl.php'; ?>
    </div>
</div>