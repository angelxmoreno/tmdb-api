<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ValidMovie $validMovie
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Valid Movie'), ['action' => 'edit', $validMovie->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Valid Movie'), ['action' => 'delete', $validMovie->id], ['confirm' => __('Are you sure you want to delete # {0}?', $validMovie->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Valid Movies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Valid Movie'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="validMovies view large-9 medium-8 columns content">
    <h3><?= h($validMovie->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Original Title') ?></th>
            <td><?= h($validMovie->original_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($validMovie->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Popularity') ?></th>
            <td><?= $this->Number->format($validMovie->popularity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($validMovie->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($validMovie->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adult') ?></th>
            <td><?= $validMovie->adult ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Video') ?></th>
            <td><?= $validMovie->video ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
