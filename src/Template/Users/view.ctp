<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Envelopes'), ['controller' => 'Envelopes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Envelope'), ['controller' => 'Envelopes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Plaid Items'), ['controller' => 'PlaidItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Plaid Item'), ['controller' => 'PlaidItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Envelopes') ?></h4>
        <?php if (!empty($user->envelopes)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('User Id') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($user->envelopes as $envelopes): ?>
                    <tr>
                        <td><?= h($envelopes->id) ?></td>
                        <td><?= h($envelopes->user_id) ?></td>
                        <td><?= h($envelopes->name) ?></td>
                        <td><?= h($envelopes->created) ?></td>
                        <td><?= h($envelopes->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Envelopes', 'action' => 'view', $envelopes->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Envelopes', 'action' => 'edit', $envelopes->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Envelopes', 'action' => 'delete', $envelopes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $envelopes->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Plaid Items') ?></h4>
        <?php if (!empty($user->plaid_items)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('User Id') ?></th>
                    <th scope="col"><?= __('Institution Id') ?></th>
                    <th scope="col"><?= __('Access Token') ?></th>
                    <th scope="col"><?= __('Item Uid') ?></th>
                    <th scope="col"><?= __('Payload') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($user->plaid_items as $plaidItems): ?>
                    <tr>
                        <td><?= h($plaidItems->id) ?></td>
                        <td><?= h($plaidItems->user_id) ?></td>
                        <td><?= h($plaidItems->institution_id) ?></td>
                        <td><?= h($plaidItems->access_token) ?></td>
                        <td><?= h($plaidItems->item_uid) ?></td>
                        <td><?= h($plaidItems->payload) ?></td>
                        <td><?= h($plaidItems->created) ?></td>
                        <td><?= h($plaidItems->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'PlaidItems', 'action' => 'view', $plaidItems->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'PlaidItems', 'action' => 'edit', $plaidItems->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'PlaidItems', 'action' => 'delete', $plaidItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $plaidItems->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
