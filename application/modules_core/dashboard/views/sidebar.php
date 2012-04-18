<div class="grid_3" id="sidebar">

	<?php echo modules::run('mcb_menu/display_control_center', array('view'=>'dashboard/sidebar_control_center')); ?>

	<?php

	if (isset($side_block)) {

		if (!is_array($side_block)) {

			$this->load->view($side_block);

		}

		else {

			foreach ($side_block as $block) {

				$this->load->view($block);

			}

		}

	}

	if (isset($side_widgets)) {

		foreach ($side_widgets as $side_widget) {

			echo modules::run($side_widget);

		}

	}

	?>

</div>