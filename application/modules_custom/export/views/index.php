<?php $this->load->view('dashboard/header'); ?>

<div class="container_10" id="center_wrapper">

	<div class="grid_7" id="content_wrapper">

		<div class="section_wrapper">

			<h3 class="title_black"><?php echo $this->lang->line('export'); ?></h3>

			<?php $this->load->view('dashboard/system_messages'); ?>

			<div class="content toggle">

				<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

					<dl>
						<dt><label><?php echo $this->lang->line('select_object'); ?>: </label></dt>
						<dd>
							<select name="object">
								<?php foreach ($objects as $object) { ?>
								<option value="<?php echo $object['object_name']; ?>"><?php echo $object['label']; ?></option>
								<?php } ?>
							</select>
						</dd>
					</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('select_format'); ?>: </label></dt>
						<dd>
							<select name="format">
								<?php foreach ($formats as $key=>$format) { ?>
								<option value="<?php echo $key; ?>"><?php echo $format; ?></option>
								<?php } ?>
							</select>
						</dd>
					</dl>

					<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />
					<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />

				</form>

			</div>

		</div>

	</div>
</div>

<?php $this->load->view('dashboard/sidebar'); ?>

<?php $this->load->view('dashboard/footer'); ?>