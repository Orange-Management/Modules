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
    <div class="box wf-100">
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
            <?php for($j = 0; $j < 7; $j++) : 
    			$isActiveMonth = ((int) $current[$i*7+$j]->format('d') === 1) ? !$isActiveMonth : $isActiveMonth; 
    		?>
                <?php if($isActiveMonth) :?>
    			<li class="day<?= $calendar->hasEventOnDate($current[$i*7+$j]) ? ' has-event' : '';?>">
    				<div class="date"><?= $current[$i*7+$j]->format('d'); ?></div>
    					<?php else: ?>
    			<li class="day other-month<?= $calendar->hasEventOnDate($current[$i*7+$j]) ? ' has-event' : '';?>">
    				<div class="date"><?= $current[$i*7+$j]->format('d'); ?></div>
    			<?php endif; ?>
    		<?php endfor; ?>
    		</li>
        </ul>
        <?php endfor;?>
    </div>
</div>
