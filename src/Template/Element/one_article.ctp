<?php if ($obj->resId === 0): ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				[<?=h($obj->postId) ?>]
				[<?=h($obj->resId) ?>]
				<?=$this->Html->link($obj->title, ['action' => 'view', $obj->postId]) ?>
				<br>
				Name: <?=$obj->name ?>
				Time: <?=h($obj->created) ?>
				Edited: <?=h($obj->modified) ?>
			</h4>
			<h5 align="right">
				<?=$this->Html->link(__('Thread!'), ['action' => 'view', $obj->postId]) ?>
				<?=$this->Html->link(__('Edit'), ['action' => 'edit', $obj->id]) ?>
				<?=$this->Form->postLink(__('Delete'), ['action' => 'delete', $obj->id], ['confirm' => __('Are you sure you want to delete # {0}?', $obj->id)]) ?>
			</h5>
			<div class="panel-body">
				<div style="padding: 15px; background-color: #FFFFFF;">
					<h3>
						<?=h($obj->content) ?>
					</h3>
					<div style="padding: 15px">
						<?php if (!empty($obj->img_name)): ?>
							<a href="<?=$this->request->webroot ?>img/<?=$obj->img_name ?>" data-lightbox='<?= $obj->img_name ?>'>
								<img src="<?=$this->request->webroot ?>img/mini/<?=$obj->img_name ?>"alt="<?=$obj->img_name ?>" height="200">
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php else: ?>
	<div class="panel panel-default" style="margin: 10px 0 20px 60px">
		<div class="panel-heading">
			<h4 class="panel-title">
				[<?=h($obj->postId) ?>]
				[<?=h($obj->resId) ?>]
				<?=$this->Html->link($obj->title, ['action' => 'view', $obj->postId]) ?>
				<br>
				Name: <?=$obj->name ?>
				Time: <?=h($obj->created) ?>
				Edited: <?=h($obj->modified) ?>
			</h4>
			<h5 align="right">
				<?=$this->Html->link(__('Thread!'), ['action' => 'view', $obj->postId]) ?>
				<?=$this->Html->link(__('Edit'), ['action' => 'edit', $obj->id]) ?>
				<?=$this->Form->postLink(__('Delete'), ['action' => 'delete', $obj->id], ['confirm' => __('Are you sure you want to delete # {0}?', $obj->id)]) ?>
			</h5>
			<div class="panel-body">
				<div style="padding: 15px; background-color: #FFFFFF;">
					<h3>
						<?=h($obj->content) ?>
					</h3>
					<div style="padding: 15px">
						<?php if (!empty($obj->img_name)): ?>
							<a href="<?=$this->request->webroot ?>img/<?=$obj->img_name ?>" data-lightbox='<?= $obj->img_name?>'>
								<img src="<?=$this->request->webroot ?>img/mini/<?=$obj->img_name ?>"alt="<?=$obj->img_name ?>" height="200">
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>



