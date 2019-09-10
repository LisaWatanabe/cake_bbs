<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New post'), ['action' => 'add']) ?></li>
    </ul>
</nav>

<div class="posts index large-10 medium-9 columns content">
    <h1><?=__('Bulletin Board') ?></h1><br>
    <p><ul type="disc">
    	Search for articles containing at least one keyword from the title, contributor, content.
    </ul></p>
    <p><?=__('{0} posts', $count) ?></p>
    <!-- <?=$this->element('search',['find' => $find, 'posts_cnt' => $posts_cnt]); ?> -->
    <div align="right">
        <p><?=$this->Paginator->sort('id', 'Order by ID') ?> / 
        <?=$this->Paginator->sort('title', 'Order by Title') ?> / 
        <?=$this->Paginator->sort('name', 'Order by Name') ?></p>
    </div>
    <!-- Search form -->
    <?=$this->Form->create(null, array(
    	'url' => array('action' => 'index'),
    )) ?>
	<div class="input-group">
		<input type="text" name="word" class="form-control" placeholder="keyword">
		<span class="input-group-btn">
			<?=$this->Form->button(__('Submit')); ?>
			<!-- <button class="btn btn-default" type="submit">
				<i class="glyphicon glyphicon-search"></i> -->
			<!-- </button> -->
		</span>
	</div>
    <div class="paginator">
        <ul class="pagination">
            <?=$this->Paginator->numbers() ?>
<!--             <?=$this->Paginator->first(' << first ') ?>
            <?=$this->Paginator->prev(' < prev ') ?>
            <?=$this->Paginator->next(' next > ') ?>
            <?=$this->Paginator->last(' last >> ') ?>
 -->        </ul>
    </div>
	<hr>
	<!-- Posts -->
    <?php foreach($data as $obj): ?>
        <?=$this->element('one_article', ['obj' => $obj]) ?>
    <?php endforeach; ?>

</div>