<?php $this->load->view('dashboard/header'); ?>

<div class="grid_10" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('tax_rate_form'); ?></h3>

		<?php $this->load->view('dashboard/system_messages'); ?>

		<div class="content toggle">

			<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

				<dl>
					<dt><label><?php echo $this->lang->line('tax_rate_name'); ?>: </label></dt>
					<dd><input type="text" name="tax_rate_name" id="tax_rate_name" value="<?php echo $this->mdl_tax_rates->tax_rate_name; ?>" /></dd>
				</dl>

				<dl>
					<dt><label><?php echo $this->lang->line('tax_rate_percent'); ?>: </label></dt>
					<dd><input type="text" name="tax_rate_percent" id="tax_rate_symbol" value="<?php echo $this->mdl_tax_rates->tax_rate_percent; ?>" /></dd>
				</dl>

				<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />
				<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />

			</form>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/footer'); ?>