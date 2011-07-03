<dl>
    <dt><label><?php echo $this->lang->line('output_type'); ?>: </label></dt>
    <dd>
        <select name="output_type" id="output_type">

            <?php if (in_array('view', $output_types)) { ?>
            <option value="view"><?php echo $this->lang->line('view'); ?></option>
            <?php } ?>

            <?php if (in_array('html', $output_types)) { ?>
            <option value="html"><?php echo $this->lang->line('html'); ?></option>
            <?php } ?>

            <?php if (in_array('pdf', $output_types)) { ?>
            <option value="pdf"><?php echo $this->lang->line('pdf'); ?></option>
            <?php } ?>

            <?php if (in_array('csv', $output_types)) { ?>
            <option value="csv"><?php echo $this->lang->line('csv'); ?></option>
            <?php } ?>
        </select>
    </dd>
</dl>