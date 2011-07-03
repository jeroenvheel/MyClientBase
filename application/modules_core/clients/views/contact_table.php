<table style="width: 100%;">
	<tr>
		<th scope="col" class="first"><?php echo $this->lang->line('id'); ?></th>
		<th scope="col"><?php echo $this->lang->line('name'); ?></th>
		<th scope="col"><?php echo $this->lang->line('email'); ?>
		<th scope="col" class="last"><?php echo $this->lang->line('actions'); ?></th>
	</tr>
	<?php foreach ($contacts as $contact) { ?>
	<tr>
		<td class="first"><?php echo $contact->contact_id; ?></td>
		<td nowrap="nowrap"><?php echo $contact->last_name . ', ' . $contact->first_name; ?></td>
		<td><?php echo $contact->email_address; ?></td>
		<td class="last">
			<a href="<?php echo site_url('clients/contacts/details/client_id/' . $contact->client_id . '/contact_id/' . $contact->contact_id); ?>" title="<?php echo $this->lang->line('view'); ?>">
				<?php echo icon('zoom'); ?>
			</a>
			<a href="<?php echo site_url('clients/contacts/form/client_id/' . $contact->client_id . '/contact_id/' . $contact->contact_id); ?>" title="<?php echo $this->lang->line('edit'); ?>">
				<?php echo icon('edit'); ?>
			</a>
			<a href="<?php echo site_url('clients/contacts/delete/client_id/' . $contact->client_id . '/contact_id/' . $contact->contact_id); ?>" title="<?php echo $this->lang->line('delete'); ?>" onclick="javascript:if(!confirm('<?php echo $this->lang->line('confirm_delete'); ?>')) return false">
				<?php echo icon('delete'); ?>
			</a>
		</td>
	</tr>
	<?php } ?>
</table>