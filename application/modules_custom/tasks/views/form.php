<?php $this->load->view('dashboard/header'); ?>

<?php $this->load->view('dashboard/jquery_date_picker'); ?>

<div class="grid_10" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('task_form'); ?></h3>

		<?php $this->load->view('dashboard/system_messages'); ?>

		<div class="content toggle">

			<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

				<dl>
					<dt><label><?php echo $this->lang->line('client');?>: </label></dt>
					<dd>
						<select name="client_id">
							<?php foreach ($clients as $client) {?>
							<option value="<?php echo $client->client_id;?>" <?php if($this->mdl_tasks->form_value('client_id') == $client->client_id) {?>selected<?php }?>><?php echo $client->client_name;?></option>
							<?php }?>
						</select>
					</dd>
				</dl>

				<dl>
					<dt><label><?php echo $this->lang->line('start_date');?>: </label></dt>
					<dd><input class="datepicker" type="text" name="start_date" value="<?php echo $this->mdl_tasks->form_value('start_date');?>" /></dd>
				</dl>

				<dl>
					<dt><label><?php echo $this->lang->line('due_date');?>: </label></dt>
					<dd><input class="datepicker" type="text" name="due_date" value="<?php echo $this->mdl_tasks->form_value('due_date');?>" /></dd>
				</dl>

				<dl>
					<dt><label><?php echo $this->lang->line('complete_date');?>: </label></dt>
					<dd><input class="datepicker" type="text" name="complete_date" value="<?php echo $this->mdl_tasks->form_value('complete_date');?>" /></dd>
				</dl>

				<dl>
					<dt><label><?php echo $this->lang->line('title');?>: </label></dt>
					<dd><input id="title" type="text" name="title" value="<?php echo $this->mdl_tasks->form_value('title');?>" /></dd>
				</dl>

				<dl>
					<dt><label><?php echo $this->lang->line('description');?>: </label></dt>
					<dd><textarea id="description" name="description" rows="10" cols="50"><?php echo $this->mdl_tasks->form_value('description');?></textarea></dd>
				</dl>

				<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit');?>" />
				<input type="submit" id="btn_submit_and_create_invoice" name="btn_submit_and_create_invoice" value="<?php echo $this->lang->line('submit_and_create_invoice');?>" />
				<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel');?>" />

			</form>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/footer'); ?>