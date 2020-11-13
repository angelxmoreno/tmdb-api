<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ValidMovie[]|\Cake\Collection\CollectionInterface $validMovies
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Valid Movie'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="validMovies index large-9 medium-8 columns content">
    <h3><?= __('Valid Movies') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('original_title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('popularity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('adult') ?></th>
                <th scope="col"><?= $this->Paginator->sort('video') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($validMovies as $validMovie): ?>
            <tr>
                <td><?= $this->Number->format($validMovie->id) ?></td>
                <td><?= h($validMovie->original_title) ?></td>
                <td><?= $this->Number->format($validMovie->popularity) ?></td>
                <td><?= h($validMovie->adult) ?></td>
                <td><?= h($validMovie->video) ?></td>
                <td><?= h($validMovie->created) ?></td>
                <td><?= h($validMovie->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $validMovie->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $validMovie->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $validMovie->id], ['confirm' => __('Are you sure you want to delete # {0}?', $validMovie->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
