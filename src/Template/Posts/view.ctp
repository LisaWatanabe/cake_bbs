<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Posts'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="posts index large-10 medium-9 columns content">
    <h1><?=__('Post detail') ?></h1>
    <?php foreach ($data as $obj): ?>
        <?=$this->element('one_article', ['obj' => $obj]) ?>
    <?php endforeach; ?>
    <hr>
    <h2><?=__('Reply form') ?></h2>
    <?php $new_post->postId = $obj->postId; ?>
    <?php $new_post->resId = $obj->resId +1; ?>
    <?php $new_post->title = "Re:" .$obj->title; ?>
    <?=$this->element('form', ['post' => $new_post, 'action' => 'add']) ?>
</div>