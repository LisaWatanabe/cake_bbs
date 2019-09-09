<div class="posts index large-9 medium-8 columns content">
    <h1><?=__('Post detail') ?></h1>
    <?php foreach ($posts as $post): ?>
        <?=$this->element('one_article', ['post' => $post]) ?>
    <?php endforeach; ?>
    <hr>
    <h2><?=__('Reply form') ?></h2>
    <?php $new_post->postId = $post->postId; ?>
    <?php $new_post->resId = $post->resId +1; ?>
    <?php $new_post->title = "Re:" .$post->title; ?>
    <?=$this->element('form', ['post' => $new_post, 'action' => 'add']) ?>
</div>