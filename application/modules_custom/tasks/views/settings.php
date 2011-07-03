<dl>
	<dt><?php echo $this->lang->line('dashboard_show_open_tasks');?></dt>
	<dd>
		<input type="checkbox" name="dashboard_show_open_tasks" value="TRUE" <?php if($this->mdl_mcb_data->setting('dashboard_show_open_tasks') == "TRUE"){?>checked<?php }?> />
	</dd>
</dl>