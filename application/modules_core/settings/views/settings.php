<?php $this->load->view('dashboard/header'); ?>

<?php $this->load->view('dashboard/jquery_date_picker'); ?>

<script type="text/javascript">
	$(function(){
		$('#accordion').accordion({active: false, collapsible: true, autoHeight: false});
		$('#tabs').tabs({ selected: <?php echo $tab_index; ?> });
	});
</script>

<div class="grid_10" id="content_wrapper">

	<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

		<div class="section_wrapper">

			<h3 class="title_black"><?php echo $this->lang->line('system_settings'); ?>

				<input type="submit" name="btn_save_settings" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo $this->lang->line('save_settings'); ?>" />

			</h3>

			<?php $this->load->view('dashboard/system_messages'); ?>

			<div class="content toggle">

				<div id="tabs">
					<ul>
						<li><a href="#tab_application"><?php echo $this->lang->line('application'); ?></a></li>
						<?php foreach ($core_tabs as $tab) { ?>
						<li><a href="#<?php echo $tab['path']; ?>"><?php echo $tab['title']; ?></a></li>
							<?php } ?>
						<li><a href="#tab_custom"><?php echo $this->lang->line('custom_modules'); ?></a></li>
					</ul>

					<div id="tab_application">
						<dl>
							<dt><label><?php echo $this->lang->line('application_version'); ?>: </label></dt>
							<dd><?php echo $this->mdl_mcb_data->setting('version'); ?></dd>
						</dl>
						<dl>
							<dt><label><?php echo $this->lang->line('database_backup'); ?>: </label></dt>
							<dd><input type="submit" name="btn_backup" value="<?php echo $this->lang->line('database_backup'); ?>" /></dd>
						</dl>
						<dl>
							<dt><label><?php echo $this->lang->line('optimize_database'); ?>: </label></dt>
							<dd><?php echo anchor('settings/optimize_db', $this->lang->line('optimize_database')); ?></dd>
						</dl>
                        <dl>
                            <dt><label><?php echo $this->lang->line('enable_profiler'); ?>: </label></dt>
                            <dd><input type="checkbox" name="enable_profiler" value="1" <?php if ($this->mdl_mcb_data->setting('enable_profiler')) { ?>checked="checked"<?php } ?> /></dd>
                        </dl>
                        <dl>
                            <dt><label><?php echo $this->lang->line('application_title'); ?>: </label></dt>
                            <dd><input type="text" name="application_title" value="<?php echo application_title(); ?>" /></dd>
                        </dl>
					</div>

					<?php foreach ($core_tabs as $tab) { ?>

					<div id="<?php echo $tab['path']; ?>">
						<?php echo modules::run($tab['settings_view']); ?>
					</div>

					<?php } ?>

					<div id="tab_custom">
						<div id="accordion">
							<?php foreach ($custom_tabs as $tab) { ?>
							<h3><a href="#"><?php echo $tab['title']; ?></a></h3>
							<div>
								<?php echo modules::run($tab['settings_view']); ?>
							</div>
							<?php } ?>
						</div>
					</div>

				</div>

				<div style="clear: both;">&nbsp;</div>

			</div>

		</div>

	</form>

</div>

<?php $this->load->view('dashboard/footer'); ?>