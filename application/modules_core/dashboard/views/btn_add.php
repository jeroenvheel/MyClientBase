<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>" style="display: inline;">
<input type="submit" name="<?php if (isset($btn_name)) { echo $btn_name; } else { ?>btn_add<?php } ?>" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php if (isset($btn_value)) { echo $btn_value; } else { echo $this->lang->line('add'); } ?>" />
</form>