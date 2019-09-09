<h1><?=__('Edit the post') ?>
<?=$this->Html->link('HOME', ['action' => 'index']) ?>
</h1>
<hr>
<div class="posts form large-9 medium-8 columns content">
    <?=$this->element('form', ['obj' => $obj, 'action' => 'edit']) ?>
</div>


