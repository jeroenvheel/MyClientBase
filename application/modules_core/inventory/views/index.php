<?php $this->load->view('dashboard/header'); ?>

<?php $this->load->view('jquery_stock_adjustment'); ?>

<div class="grid_7" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('inventory_items'); ?><?php $this->load->view('dashboard/btn_add', array('btn_value'=>$this->lang->line('add'))); ?></h3>

		<div class="content toggle no_padding">

			<table>
				<tr>
					<th scope="col" class="first" style="width: 10%;"><?php echo $this->lang->line('id'); ?></th>
                    <th scope="col" style="width: 25%;"><?php echo $this->lang->line('type'); ?></th>
					<th scope="col" style="width: 25%;"><?php echo $this->lang->line('item'); ?></th>
                    <th scope="col" style="width: 12%;"><?php echo $this->lang->line('stock'); ?></th>
					<th scope="col" style="width: 12%;"><?php echo $this->lang->line('price'); ?></th>
					<th scope="col" class="last" style="width: 15%;"><?php echo $this->lang->line('actions'); ?></th>
				</tr>
				<?php foreach ($items as $item) { ?>
				<tr>
					<td class="first"><?php echo $item->inventory_id; ?></td>
                    <td><?php echo $item->inventory_type; ?></td>
					<td><?php echo $item->inventory_name; ?></td>
                    <td id="stock_td_<?php echo $item->inventory_id; ?>">
                        <?php if ($item->inventory_track_stock) { ?>
                        <a href="javascript:void(0)" class="stock_adjust_link" id="<?php echo $item->inventory_id; ?>" title="<?php echo $this->lang->line('adjust_stock'); ?>"><?php echo $item->inventory_stock; ?></a>
                        <?php } else { ?>
                        --
                        <?php } ?>
                    </td>
					<td><?php echo display_currency($item->inventory_unit_price); ?></td>
					<td class="last">
						<a href="<?php echo site_url('inventory/form/inventory_id/' . $item->inventory_id); ?>" title="<?php echo $this->lang->line('edit'); ?>">
							<?php echo icon('edit'); ?>
						</a>
						<a href="<?php echo site_url('inventory/delete/inventory_id/' . $item->inventory_id); ?>" title="<?php echo $this->lang->line('delete'); ?>" onclick="javascript:if(!confirm('<?php echo $this->lang->line('confirm_delete'); ?>')) return false">
							<?php echo icon('delete'); ?>
						</a>
					</td>
				</tr>
				<?php } ?>
			</table>

			<?php if ($this->mdl_inventory->page_links) { ?>
			<div id="pagination">
				<?php echo $this->mdl_inventory->page_links; ?>
			</div>
			<?php } ?>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/sidebar', array('side_block'=>'inventory/sidebar')); ?>

<?php $this->load->view('dashboard/footer'); ?>