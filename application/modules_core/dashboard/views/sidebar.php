<div class="grid_3" id="sidebar">

	<?php

	if (isset($show_quicklinks)) {

		$this->load->view('dashboard/sidebar_quicklinks');

	}

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