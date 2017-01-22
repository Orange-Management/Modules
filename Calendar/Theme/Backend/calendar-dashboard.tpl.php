<?php
$calendar = $this->getData('calendar');
?>
<section class="wf-75 floatLeft">
    <div class="box w-100">
        <ul class="btns floatLeft">
            <li><a href="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/backend/calendar/dashboard?date=' . $calendar->getDate()->createModify(0, -1, 0)->format('Y-m-d')) ?>"><i class="fa fa-arrow-left"></i></a>
            <li><a href="<?= \phpOMS\Uri\UriFactory::build('/{/lang}/backend/calendar/dashboard?date=' . $calendar->getDate()->createModify(0, 1, 0)->format('Y-m-d')) ?>"><i class="fa fa-arrow-right"></i></a>
        </ul>
        <ul class="btns floatRight">
            <li><a href=""><?= $this->getText('Day') ?></a>
            <li><a href=""><?= $this->getText('Week') ?></a>
            <li><a href=""><?= $this->getText('Month') ?></a>
            <li><a href=""><?= $this->getText('Year') ?></a>
        </ul>
    </div>
    <div class="box w-100">
        <div class="m-calendar-month">
            <?php $current = new \phpOMS\Datatypes\SmartDateTime($calendar->getDate()->format('Y') . '-' . $calendar->getDate()->format('m') . '-' . '01'); for($i = 0; $i < 6; $i++) : ?>
                <div class="wf-100">
                <?php for($j = 0; $j < 7; $j++) : ?>
                    <div contextmenu="calendar-day-menu" style="display: inline-block; box-sizing: border-box; width: 13.0%; height: 100px; border: 1px solid #000; margin: 0; padding: 3px; overflow: hidden">
                    <?php if($calendar->getDate()->getFirstDayOfMonth() <= $i*7+$j+1 && $calendar->getDate()->getDaysOfMonth() >= $i*7+$j+1) {
                        echo ($i*7+$j+1) . ' ' . jddayofweek($j, 1);
                    } else {
                        echo $current->createModify(0, 0, -2)->format('d') . ' ' . jddayofweek($j, 1);
                    } ?>
                        <ul>
                        <?php
                        $events = $calendar->getEventByDate($current);
                        $current->smartModify(0, 0, 1);
                    foreach($events as $event) : ?>
                        <li><span class="tag purple" style="white-space: nowrap;"><?= $event->getName(); ?></span>
                    <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endfor; ?>
                </div>
            <?php endfor;?>
        </div>
    </div>
</section>

<section class="wf-25 floatLeft">
    <section class="box w-100">
        <header><h1>Title</h1></header>

        <div class="inner">
            <form>
                <table class="layout wf-100">
                    <tr>
                        <td><label>Layout</label>
                    <tr>
                        <td><select>
                                <option>
                            </select>
                </table>
            </form>
        </div>
    </section>

    <section class="box w-100">
        <header><h1>Calendars</h1></header>

        <div class="inner">
            <ul class="boxed">
                <li><i class="fa fa-times warning"></i> <span class="check"><input type="checkbox" id="iDefault" checked><label for="iDefault">Default</label></span><i class="fa fa-cogs floatRight"></i>
            </ul>
            <div class="spacer"></div>
            <button><i class="fa fa-calendar-plus-o"></i> <?= $this->getText('Add', 0, 0); ?></button> <button><i class="fa fa-calendar-check-o"></i> <?= $this->getText('Create', 0, 0); ?></button>
        </div>
    </section>
</section>

<menu type="context" id="calendar-day-menu">
    <menuitem label="<?= $this->getText('NewEvent') ?>"></menuitem>
</menu>

<menu type="context" id="calendar-event-menu">
    <menuitem label="Edit"></menuitem>
    <menuitem label="Accept" disabled></menuitem>
    <menuitem label="Re-Schedule"></menuitem>
    <menuitem label="Decline"></menuitem>
    <menuitem label="Delete"></menuitem>
</menu>

<div class="hidden">
    <section class="box">
        <div class="inner">
            <form>
                <table class="layout">
                    <tr><td><label for="iTitle">Title</label>
                    <tr><td><input type="text" id="">
                    <tr><td><label for="iTitle">Description</label>
                    <tr><td><textarea></textarea>
                    <tr><td><label for="iTitle">To</label>
                    <tr><td><input type="text" id="">
                    <tr><td><label for="iTitle">Files</label>
                    <tr><td><input type="text" id="">
                </table>
            </form>
        </div>
    </section>
</div>
