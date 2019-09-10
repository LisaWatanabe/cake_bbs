<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Posts'), ['action' => 'index']) ?></li>
    </ul>
</nav>

<h1>
	<?=__('Edit the post') ?>
</h1>
	<div class="posts form large-10 medium-9 columns content">
	    <?=$this->element('form', ['data' => $data, 'action' => 'edit']) ?>
	</div>


