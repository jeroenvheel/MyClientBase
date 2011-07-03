<?php $this->load->view('header'); ?>

<div class="grid_10" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('myclientbase') . ' ' . $this->lang->line('setup'); ?></h3>

		<?php $this->load->view('dashboard/system_messages'); ?>

		<div class="content toggle">

			<h3><?php echo $this->lang->line('install'); ?></h3>

			<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

				<p><?php echo $this->lang->line('provide_to_install'); ?></p>

				<dt><label>* <?php echo $this->lang->line('first_name'); ?>: </label></dt>
				<dd><input type="text" name="first_name" value="<?php echo $this->mdl_setup->form_value('first_name'); ?>" /></dd>

				<dt><label>* <?php echo $this->lang->line('last_name'); ?>: </label></dt>
				<dd><input type="text" name="last_name" value="<?php echo $this->mdl_setup->form_value('last_name'); ?>" /></dd>

				<dt><label>* <?php echo $this->lang->line('username'); ?>: </label></dt>
				<dd><input type="text" name="username" value="<?php echo $this->mdl_setup->form_value('username'); ?>"/></dd>

				<dt><label>* <?php echo $this->lang->line('password'); ?>: </label></dt>
				<dd><input type="password" name="password" /></dd>

				<dt><label>* <?php echo $this->lang->line('password_verify'); ?>: </label></dt>
				<dd><input type="password" name="passwordv" /></dd>

				<dt><label><?php echo $this->lang->line('company_name'); ?></label></dt>
				<dd><input type="text" name="company_name" value="<?php echo $this->mdl_setup->form_value('company_name'); ?>"/></dd>

				<dt><label><?php echo $this->lang->line('email_address'); ?></label></dt>
				<dd><input type="text" name="email_address" value="<?php echo $this->mdl_setup->form_value('email_address'); ?>"/></dd>

				<dt><label><?php echo $this->lang->line('street_address'); ?></label></dt>
				<dd><input type="text" name="address" value="<?php echo $this->mdl_setup->form_value('address'); ?>"/></dd>

				<dt><label><?php echo $this->lang->line('city'); ?></label></dt>
				<dd><input type="text" name="city" value="<?php echo $this->mdl_setup->form_value('city'); ?>"/></dd>

				<dt><label><?php echo $this->lang->line('state'); ?></label></dt>
				<dd><input type="text" name="state" value="<?php echo $this->mdl_setup->form_value('state'); ?>"/></dd>

				<dt><label><?php echo $this->lang->line('zip'); ?></label></dt>
				<dd><input type="text" name="zip" value="<?php echo $this->mdl_setup->form_value('zip'); ?>"/></dd>

				<dt><label><?php echo $this->lang->line('country'); ?></label></dt>
				<dd><input type="text" name="country" value="<?php echo $this->mdl_setup->form_value('country'); ?>"/></dd>

				<dt><label><?php echo $this->lang->line('phone_number'); ?></label></dt>
				<dd><input type="text" name="phone_number" value="<?php echo $this->mdl_setup->form_value('phone_number'); ?>"/></dd>

				<dt><label><?php echo $this->lang->line('mobile_number'); ?></label></dt>
				<dd><input type="text" name="mobile_number" value="<?php echo $this->mdl_setup->form_value('mobile_number'); ?>"/></dd>

				<dt><label><?php echo $this->lang->line('fax_number'); ?></label></dt>
				<dd><input type="text" name="fax_number" value="<?php echo $this->mdl_setup->form_value('fax_number'); ?>"/></dd>

				<dt><label><?php echo $this->lang->line('web_address'); ?></label></dt>
				<dd><input type="text" name="web_address" value="<?php echo $this->mdl_setup->form_value('web_address'); ?>"/></dd>

				<input type="submit" name="btn_install" id="btn_submit" value="<?php echo $this->lang->line('install'); ?>" />

			</form>

			<div style="clear: both;">&nbsp;</div>

		</div>

	</div>

</div>

<?php $this->load->view('footer'); ?>