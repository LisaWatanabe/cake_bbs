<h1><?=__('Create post') ?></h1>
<div class="posts form large-9 medium-8 columns content">
    <?php $post->postId = -1; ?>
    <?=$this->element('form', ['post' => $post, 'action' => 'add']) ?>
</div>