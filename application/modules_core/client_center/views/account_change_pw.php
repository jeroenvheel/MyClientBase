<?php $this->load->view('header'); ?>

<?php $this->load->view('dashboard/jquery_clear_password'); ?>

<div class="container_10" id="center_wrapper">

	<div class="grid_7" id="content_wrapper">

		<div class="section_wrapper">

			<h3 class="title_black"><?php echo $this->lang->line('change_password'); ?></h3>

			<?php $this->load->view('dashboard/system_messages'); ?>

			<div class="content toggle">

				<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

					<dl>
						<dt><label><?php echo $this->lang->line('password'); ?>: </label></dt>
						<dd><input type="password" name="password" id="password" /></dd>
					</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('password_verify'); ?>: </label></dt>
						<dd><input type="password" name="passwordv" id="passwordv" /></dd>
					</dl>

                    <div style="clear: both;">&nbsp;</div>

					<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />
					<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />

					<div style="clear: both;">&nbsp;</div>



				</form>

			</div>

		</div>

	</div>
</div>

<?php $this->load->view('dashboard/footer'); ?>