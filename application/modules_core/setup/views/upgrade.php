<?php $this->load->view('header'); ?>

<div class="grid_10" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('myclientbase') . ' ' . $this->lang->line('setup'); ?></h3>

		<div class="content toggle">

			<h3><?php echo $this->lang->line('upgrade'); ?></h3>

			<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

			<p style="margin-left: 20px; margin-right: 20px;"><?php echo $this->lang->line('upgrade_database_backup'); ?></p>

			<input type="submit" name="btn_db_backup" value="<?php echo $this->lang->line('database_backup'); ?>" class="button" />

			<input type="submit" name="btn_upgrade" value="<?php echo $this->lang->line('upgrade'); ?>" class="button" />

			</form>


		</div>

	</div>

</div>

<?php $this->load->view('footer'); ?>