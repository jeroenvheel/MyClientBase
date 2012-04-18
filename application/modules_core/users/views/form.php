<?php $this->load->view('dashboard/header'); ?>

<script type="text/javascript">
	$(function(){
		$('#tabs').tabs({ selected: <?php echo isset($tab_index) ? $tab_index : 0; ?> });
	});
</script>

<div class="grid_10" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('user_account_form'); ?></h3>

		<?php $this->load->view('dashboard/system_messages'); ?>

		<div class="content toggle">

			<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

				<div id="tabs">

					<ul>
						<li><a href="#tab_details"><?php echo $this->lang->line('details'); ?></a></li>
                        <li><a href="#tab_settings"><?php echo $this->lang->line('settings'); ?></a></li>
					</ul>

					<div id="tab_details">
						<?php $this->load->view('form_tab_details'); ?>
					</div>

                    <div id="tab_settings">
                        <?php $this->load->view('form_tab_settings'); ?>
                    </div>

				</div>

            <div style="clear: both;">&nbsp;</div>



			</form>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/footer'); ?>