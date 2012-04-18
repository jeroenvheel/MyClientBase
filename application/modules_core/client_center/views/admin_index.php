<?php $this->load->view('dashboard/header'); ?>

<div class="grid_7" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('client_center'); ?>
			<span style="font-size: 60%;">
				<?php $this->load->view('dashboard/btn_add', array('btn_name'=>'btn_add_account', 'btn_value'=>$this->lang->line('create_account'))); ?>
			</span>
		</h3>

		<?php $this->load->view('dashboard/system_messages'); ?>

		<div class="content toggle no_padding">

			<table>
				<tr>
					<th scope="col" class="first"><?php echo $this->lang->line('id'); ?></th>
					<th scope="col"><?php echo $this->lang->line('client'); ?></th>
					<th scope="col"><?php echo $this->lang->line('username'); ?></th>
					<th scope="col"><?php echo $this->lang->line('last_login'); ?></th>
					<th scope="col"><?php echo $this->lang->line('edit'); ?></th>
					<th scope="col" class="last"><?php echo $this->lang->line('delete'); ?></th>
				</tr>
				<?php foreach ($client_accounts as $account) { ?>
				<tr>
					<td class="first"><?php echo $account->user_id; ?></td>
					<td><?php echo $account->client_name; ?></td>
					<td><?php echo $account->username; ?></td>
					<td><?php echo format_date($account->last_login); ?></td>
					<td><?php echo anchor('client_center/admin/form/user_id/' . $account->user_id, $this->lang->line('edit'), array('class'=>'edit')); ?></td>
					<td class="last"><?php echo anchor('client_center/admin/delete/user_id/' . $account->user_id, $this->lang->line('delete'), array('class'=>'delete', 'onclick'=>"javascript:if(!confirm('" . $this->lang->line('confirm_delete') . "')) return false")); ?></td>
				</tr>
				<?php } ?>
			</table>

			<?php if ($this->mdl_client_center->page_links) { ?>
			<div id="pagination">
				<?php echo $this->mdl_client_center->page_links; ?>
			</div>
			<?php } ?>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/sidebar', array('side_block'=>'client_center/admin_sidebar')); ?>

<?php $this->load->view('dashboard/footer'); ?>