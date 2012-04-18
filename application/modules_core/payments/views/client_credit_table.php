<table style="width: 100%;">
    <tr>
		<?php if (isset($sort_links) AND $sort_links == TRUE) { ?>
			<th scope="col" class="first"><?php echo anchor('client_credits/index/order_by/client_credit_id', $this->lang->line('id')); ?></th>
			<th scope="col"><?php echo anchor('client_credits/index/order_by/date', $this->lang->line('date')); ?></th>
			<th scope="col"><?php echo anchor('client_credits/index/order_by/client', $this->lang->line('client')); ?></th>
			<th scope="col" class="col_amount"><?php echo anchor('client_credits/index/order_by/amount', $this->lang->line('amount')); ?></th>
			<th scope="col" class="last"><?php echo $this->lang->line('actions'); ?></th>
		<?php } else { ?>
			<th scope="col" class="first"><?php echo $this->lang->line('id'); ?></th>
			<th scope="col"><?php echo $this->lang->line('date'); ?></th>
			<th scope="col"><?php echo $this->lang->line('client'); ?></th>
			<th scope="col" class="col_amount"><?php echo $this->lang->line('amount'); ?></th>
			<th scope="col" class="last"><?php echo $this->lang->line('actions'); ?></th>
		<?php } ?>
	</tr>
	<?php foreach ($client_credits as $client_credit) {
		if(!uri_assoc('client_credit_id') OR uri_assoc('client_credit_id') <> $client_credit->client_credit_id) { ?>
			<tr class="hoverall">
				<td class="first"><?php echo $client_credit->client_credit_id; ?></td>
				<td><?php echo format_date($client_credit->client_credit_date); ?></td>
				<td><?php echo anchor('clients/form/client_id/' . $client_credit->client_id, $client_credit->client_name); ?></td>
				<td class="col_amount"><?php echo display_currency($client_credit->client_credit_amount); ?></td>
				<td class="last">
					<a href="<?php echo site_url('payments/client_credits/form/client_credit_id/' . $client_credit->client_credit_id); ?>" title="<?php echo $this->lang->line('edit'); ?>">
						<?php echo icon('edit'); ?>
					</a>
					<a href="<?php echo site_url('payments/client_credits/delete/client_credit_id/' . $client_credit->client_credit_id); ?>" title="<?php echo $this->lang->line('delete'); ?>" onclick="javascript:if(!confirm('<?php echo $this->lang->line('confirm_delete'); ?>')) return false">
						<?php echo icon('delete'); ?>
					</a>
				</td>
			</tr>
		<?php } ?>
	<?php } ?>

</table>

<?php if ($this->mdl_client_credits->page_links) { ?>
<div id="pagination">
	<?php echo $this->mdl_client_credits->page_links; ?>
</div>
<?php } ?>