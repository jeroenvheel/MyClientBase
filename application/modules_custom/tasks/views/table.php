<?php if ($tasks) {?>

<table style="width: 100%;">
    <tr>
		<?php if (isset($show_task_selector)) { ?><th scope="col" class="first">&nbsp;</th><?php } ?>
		<th scope="col" <?php if (!isset($show_task_selector)) { ?>class="first"<?php } ?>><?php echo $this->lang->line('client');?></th>
		<th scope="col"><?php echo $this->lang->line('start_date');?></th>
		<th scope="col"><?php echo $this->lang->line('complete_date');?></th>
		<th scope="col"><?php echo $this->lang->line('title');?></th>
		<th scope="col"><?php echo $this->lang->line('edit');?></th>
		<th scope="col" class="last"><?php echo $this->lang->line('delete');?></th>
    </tr>
	<?php foreach ($tasks as $task) {?>
    <tr>
		<?php if (isset($show_task_selector)) { ?><td class="first"><input type="checkbox" class="task_id_check" name="task_id[]" value="<?php echo $task->task_id; ?>" /></td><?php } ?>
		<td <?php if (!isset($show_task_selector)) { ?>class="first"<?php } ?>><?php echo $task->client_name;?></td>
		<td><?php if($task->start_date){echo format_date($task->start_date);}?></td>
		<td><?php if($task->complete_date){echo format_date($task->complete_date);}?></td>
		<td><?php echo $task->title;?></td>
		<td><?php echo anchor('tasks/form/task_id/' . $task->task_id, $this->lang->line('edit'), array('class'=>'edit'));?></td>
		<td class="last"><?php echo anchor('tasks/delete/task_id/' . $task->task_id, $this->lang->line('delete'), array('class'=>'delete', 'onclick'=>"javascript:if(!confirm('" . $this->lang->line('confirm_delete') . "')) return false"));?></td>
    </tr>
	<?php }?>
</table>

<?php if ($this->mdl_tasks->page_links) { ?>
<div id="pagination">
	<?php echo $this->mdl_tasks->page_links; ?>
</div>
<?php } ?>

<?php } else {?>
	<p><?php echo $this->lang->line('no_records_found');?>.</p><br />
<?php }?>