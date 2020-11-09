<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ValidMovie $validMovie
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $validMovie->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $validMovie->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Valid Movies'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="validMovies form large-9 medium-8 columns content">
    <?= $this->Form->create($validMovie) ?>
    <fieldset>
        <legend><?= __('Edit Valid Movie') ?></legend>
        <?php
        echo $this->Form->control('origininal_title');
        echo $this->Form->control('popularity');
        echo $this->Form->control('adult');
        echo $this->Form->control('video');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
