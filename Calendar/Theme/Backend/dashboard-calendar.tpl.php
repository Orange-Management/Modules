<?php
$calendar = $this->getData('calendar');
?>
<div id="calendar" class="m-calendar m-calendar-mini col-xs-12 col-md-6" draggable="true" data-action='[
    {
        "listener": "click", "selector": "#calendar span.tag", "action": [
			{"key": 1, "type": "dom.popup", "tpl": "calendar-event-popup-tpl", "aniIn": "fadeIn"}
        ]
    }
]'>
	<ul class="weekdays green">
		<li><?= $this->getHtml('Sunday'); ?>
        <li><?= $this->getHtml('Monday'); ?>
        <li><?= $this->getHtml('Tuesday'); ?>
        <li><?= $this->getHtml('Wednesday'); ?>
        <li><?= $this->getHtml('Thursday'); ?>
        <li><?= $this->getHtml('Friday'); ?>
        <li><?= $this->getHtml('Saturday'); ?>
	</ul>
	<?php $current = $calendar->getDate()->getMonthCalendar(0); $isActiveMonth = false;
    for($i = 0; $i < 6; $i++) : ?>
    <ul class="days">
        <?php for($j = 0; $j < 7; $j++) : $isActiveMonth = ($current[$i*7+$j] === 1) ? !$isActiveMonth : $isActiveMonth; ?>
            <?php if($isActiveMonth) :?>
			<li class="day">
				<div class="date"><?= $current[$i*7+$j]; ?></div>
					<?php else: ?>
			<li class="day other-month">
				<div class="date"><?= $current[$i*7+$j]; ?></div>
					<?php endif; ?>
				<?php
				$events = $calendar->getEventByDate(new \DateTime('now'));
				foreach($events as $event) : ?> 
					<div id="event-tag-<?= htmlspecialchars($event->getId(), ENT_COMPAT, 'utf-8'); ?>" class="event">
			<div class="event-desc"><?= htmlspecialchars($event->getName(), ENT_COMPAT, 'utf-8'); ?></div>
			<div class="event-time">2:00pm to 5:00pm</div>
					</div>
				<?php endforeach; ?>
			<?php endfor; ?>
			</li>
    </ul>
    <?php endfor;?>
</div>
