<?php $this->load->view('dashboard/header'); ?>

<div class="container_10" id="center_wrapper">

	<div class="grid_7" id="content_wrapper">

		<div class="section_wrapper">

			<h3 class="title_black"><?php echo $this->lang->line('inventory_item_form'); ?></h3>

			<?php $this->load->view('dashboard/system_messages'); ?>

			<div class="content toggle">

				<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

				<dl>
					<dt><label><?php echo $this->lang->line('inventory_type'); ?>: </label></dt>
					<dd>
                        <select name="inventory_type_id">
                            <option value=""></option>
                            <?php foreach ($inventory_types as $inventory_type) { ?>
                            <option value="<?php echo $inventory_type->inventory_type_id; ?>" <?php if ($this->mdl_inventory->form_value('inventory_type_id') == $inventory_type->inventory_type_id) { ?>selected="selected"<?php } ?>><?php echo $inventory_type->inventory_type; ?></option>
                            <?php } ?>
                        </select>
                    </dd>
				</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('item_name'); ?>: </label></dt>
						<dd><input type="text" name="inventory_name" id="inventory_name" value="<?php echo $this->mdl_inventory->form_value('inventory_name'); ?>" /></dd>
					</dl>
					
					<dl>
						<dt><label><?php echo $this->lang->line('item_description'); ?></label></dt>
						<dd><textarea name="inventory_description" id="inventory_description"><?php echo $this->mdl_inventory->form_value('inventory_description'); ?></textarea></dd>
					</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('unit_price'); ?>: </label></dt>
						<dd><input type="text" name="inventory_unit_price" id="inventory_unit_price" value="<?php echo format_number($this->mdl_inventory->form_value('inventory_unit_price')); ?>" /></dd>
					</dl>

                    <dl>
                        <dt><label><?php echo $this->lang->line('tax_rate'); ?>: </label></dt>
                        <dd>
                            <select name="tax_rate_id">
                                <?php foreach ($tax_rates as $tax_rate) { ?>
                                <option value="<?php echo $tax_rate->tax_rate_id; ?>" <?php if(($this->mdl_inventory->form_value('tax_rate_id') and $this->mdl_inventory->form_value('tax_rate_id') == $tax_rate->tax_rate_id) or (!$this->mdl_inventory->form_value('tax_rate_id') and $this->mdl_mcb_data->setting('default_item_tax_rate_id') == $tax_rate->tax_rate_id)) { ?>selected="selected"<?php } ?>><?php echo $tax_rate->tax_rate_percent . '% - ' . $tax_rate->tax_rate_name; ?></option>
                                <?php } ?>
                            </select>
                        </dd>
                    </dl>
                    
                    <dl>
                        <dt><label><?php echo $this->lang->line('track_stock'); ?>: </label></dt>
                        <dd><input type="checkbox" name="inventory_track_stock" value="1" <?php if ($this->mdl_inventory->form_value('inventory_track_stock')) { ?>checked="checked"<?php } ?> /></dd>
                    </dl>

                    <div style="clear: both;">&nbsp;</div>

					<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />
					<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />

				</form>

			</div>

		</div>

	</div>
</div>

<?php $this->load->view('dashboard/sidebar', array('side_block'=>'inventory/sidebar')); ?>

<?php $this->load->view('dashboard/footer'); ?>