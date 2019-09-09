<?=$this->Form->create($post, array('url' => array('action' => $action),)) ?>
<fieldset>
	<?php
		echo $this->Form->hidden('postId');
		echo $this->Form->hidden('resId');
		echo $this->Form->input('title');
		echo $this->Form->input('name');
		echo $this->Form->input('content');
		echo "<br>";
	 ?>
</fieldset>
<?=$this->Form->button(__('Send')) ?>
<?=$this->Form->end() ?>