<div class="section_wrapper">

	<h3 class="title_black"><?php echo $this->lang->line('control_center'); ?></h3>
	<ul class="quicklinks content toggle">
		<?php foreach ($menu_items as $item) { ?>
		<li><?php echo anchor($item['href'], $this->lang->line($item['title'])); ?></li>
		<?php } ?>
	</ul>

</div>