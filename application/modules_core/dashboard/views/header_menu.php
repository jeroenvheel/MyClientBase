<?php foreach ($menu_items as $item) { ?>

<li>
    <?php if (isset($item['href'])) { ?>
    <?php echo anchor($item['href'], $this->lang->line($item['title'])); ?>
    <?php } else { ?>
    <a href="#"><?php echo $this->lang->line($item['title']); ?></a>
    <?php } ?>
    <?php if (isset($item['submenu'])) { ?>
    <ul>
        <?php foreach ($item['submenu'] as $subitem) { ?>
        <?php if (!isset($subitem['submenu'])) { ?>
        <li><?php echo anchor($subitem['href'], $this->lang->line($subitem['title'])); ?></li>
        <?php } else { ?>
        <?php if (isset($subitem['href'])) { ?>
        <li><?php echo anchor($subitem['href'], $this->lang->line($subitem['title'])); ?>
        <?php } else { ?>
        <li><a href="#"><?php echo $this->lang->line($subitem['title']); ?></a>
        <?php } ?>
            <ul>
            <?php foreach ($subitem['submenu'] as $submenu) { ?>
            <li><?php echo anchor($submenu['href'], $this->lang->line($submenu['title'])); ?></li>
            <?php } ?>
            </ul>
        </li>
        <?php } ?>
        <?php } ?>
    </ul>
    <?php } ?>
</li>

<?php } ?>

<?php if ($this->session->userdata('global_admin') and $this->mdl_mcb_modules->num_custom_modules_enabled) { ?>

<li><?php echo anchor('mcb_modules', $this->lang->line('custom_modules')); ?>
	<ul>
		<?php $x = 0; foreach ($this->mdl_mcb_modules->custom_modules as $module) {;?>
			<?php if ($module->module_enabled) { $x++;?>
				<li <?php if ($x == $this->mdl_mcb_modules->num_custom_modules_enabled) { ?>class="last"<?php } ?>>
				<?php echo anchor($module->module_path, $module->module_name); ?>
				</li>
			<?php } ?>
		<?php } ?> 

	</ul>
</li>
<?php } ?>

<li><?php echo anchor('sessions/logout', $this->lang->line('log_out')); ?></li>
