<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Keyword $keyword
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $keyword->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $keyword->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Keywords'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Movies'), ['controller' => 'Movies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Movie'), ['controller' => 'Movies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="keywords form large-9 medium-8 columns content">
    <?= $this->Form->create($keyword) ?>
    <fieldset>
        <legend><?= __('Edit Keyword') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('movies._ids', ['options' => $movies]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
