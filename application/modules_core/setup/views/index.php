<?php $this->load->view('header'); ?>

<div class="grid_10" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('myclientbase') . ' ' . $this->lang->line('setup'); ?></h3>

		<div class="content toggle">

			<h3><?php echo $this->lang->line('license_agreement'); ?></h3>

			<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

				<textarea style="width: 100%; height: 400px;" readonly><?php $this->load->view('license_agreement'); ?></textarea>

				<input type="submit" name="btn_agree" value="<?php echo $this->lang->line('i_agree'); ?>" />

			</form>

		</div>

		<div style="clear: both;">&nbsp;</div>

	</div>

</div>

<?php $this->load->view('footer'); ?>