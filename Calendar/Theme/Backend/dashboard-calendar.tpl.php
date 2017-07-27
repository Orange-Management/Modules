<?php
$calendar = $this->getData('calendar');
?>
<div id="calendar" class="m-calendar-month" data-action='[
    {
        "listener": "click", "selector": "#calendar span.tag", "action": [
			{"key": 1, "type": "dom.popup", "tpl": "calendar-event-popup-tpl", "aniIn": "fadeIn"}
        ]
    }
]'>
<?php $current = new \phpOMS\Datatypes\SmartDateTime($calendar->getDate()->format('Y') . '-' . $calendar->getDate()->format('m') . '-' . '01'); 
for($i = 0; $i < 6; $i++) : ?>
<div class="wf-100">
    <?php for($j = 0; $j < 7; $j++) : ?>
        <div contextmenu="calendar-day-menu" style="display: inline-block; box-sizing: border-box; width: 13.0%; height: 50px; border: 1px solid #000; margin: 0; padding: 3px; overflow: hidden">
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
			<li><span id="event-tag-<?= htmlspecialchars($event->getId(), ENT_COMPAT, 'utf-8'); ?>" class="tag purple" style="white-space: nowrap;"><?= htmlspecialchars($event->getName(), ENT_COMPAT, 'utf-8'); ?></span>
			<?php endforeach; ?>
		</ul>
	</div>
    <?php endfor; ?>
</div>
<?php endfor;?>
</div>