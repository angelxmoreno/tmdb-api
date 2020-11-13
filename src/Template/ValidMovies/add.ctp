<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ValidMovie $validMovie
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Valid Movies'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="validMovies form large-9 medium-8 columns content">
    <?= $this->Form->create($validMovie) ?>
    <fieldset>
        <legend><?= __('Add Valid Movie') ?></legend>
        <?php
            echo $this->Form->control('original_title');
            echo $this->Form->control('popularity');
            echo $this->Form->control('adult');
            echo $this->Form->control('video');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
