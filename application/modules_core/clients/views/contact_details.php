<?php $this->load->view('dashboard/header'); ?>

<div class="container_10" id="center_wrapper">

	<div class="grid_10" id="content_wrapper">

		<div class="section_wrapper">

			<h3 class="title_black"><?php echo $contact->first_name . ' ' . $contact->last_name; ?></h3>

			<div class="content toggle">

				<dl>
					<dt><?php echo $this->lang->line('street_address'); ?>: </dt>
					<dd><?php echo $contact->address; ?><?php if ($contact->address_2) { ?><br /><?php echo $contact->address_2;} ?></dd>
				</dl>

				<dl>
					<dt><?php echo $this->lang->line('city'); ?>: </dt>
					<dd><?php echo $contact->city; ?></dd>
				</dl>

				<dl>
					<dt><?php echo $this->lang->line('state'); ?>: </dt>
					<dd><?php echo $contact->state; ?></dd>
				</dl>

				<dl>
					<dt><?php echo $this->lang->line('zip'); ?>: </dt>
					<dd><?php echo $contact->zip; ?></dd>
				</dl>

				<dl>
					<dt><?php echo $this->lang->line('country'); ?>: </dt>
					<dd><?php echo $contact->country; ?></dd>
				</dl>

				<dl>
					<dt><?php echo $this->lang->line('email_address'); ?>: </dt>
					<dd><?php echo auto_link($contact->email_address); ?></dd>
				</dl>

				<dl>
					<dt><?php echo $this->lang->line('web_address'); ?>: </dt>
					<dd><?php echo auto_link($contact->web_address, 'both', TRUE); ?></dd>
				</dl>

				<dl>
					<dt><?php echo $this->lang->line('phone_number'); ?>: </dt>
					<dd><?php echo $contact->phone_number; ?></dd>
				</dl>

				<dl>
					<dt><?php echo $this->lang->line('fax_number'); ?>: </dt>
					<dd><?php echo $contact->fax_number; ?></dd>
				</dl>

				<dl>
					<dt><?php echo $this->lang->line('mobile_number'); ?>: </dt>
					<dd><?php echo $contact->mobile_number; ?></dd>
				</dl>

				<dl>
					<dt><?php echo $this->lang->line('notes'); ?>: </dt>
					<dd><?php echo nl2br($contact->notes); ?></dd>
				</dl>

				<div style="clear: both;">&nbsp;</div>

			</div>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/footer'); ?>