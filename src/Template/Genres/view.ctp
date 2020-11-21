<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Genre $genre
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Genre'), ['action' => 'edit', $genre->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Genre'), ['action' => 'delete', $genre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $genre->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Genres'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Genre'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Movies'), ['controller' => 'Movies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Movie'), ['controller' => 'Movies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="genres view large-9 medium-8 columns content">
    <h3><?= h($genre->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($genre->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($genre->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($genre->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($genre->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Movies') ?></h4>
        <?php if (!empty($genre->movies)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Title') ?></th>
                    <th scope="col"><?= __('Tagline') ?></th>
                    <th scope="col"><?= __('Overview') ?></th>
                    <th scope="col"><?= __('Is Adult') ?></th>
                    <th scope="col"><?= __('Budget') ?></th>
                    <th scope="col"><?= __('Revenue') ?></th>
                    <th scope="col"><?= __('Language') ?></th>
                    <th scope="col"><?= __('Homepage') ?></th>
                    <th scope="col"><?= __('Status') ?></th>
                    <th scope="col"><?= __('Runtime') ?></th>
                    <th scope="col"><?= __('Vote Count') ?></th>
                    <th scope="col"><?= __('Popularity') ?></th>
                    <th scope="col"><?= __('Vote Average') ?></th>
                    <th scope="col"><?= __('Imdb Uid') ?></th>
                    <th scope="col"><?= __('Facebook Uid') ?></th>
                    <th scope="col"><?= __('Instagram Uid') ?></th>
                    <th scope="col"><?= __('Twitter Uid') ?></th>
                    <th scope="col"><?= __('Videos Count') ?></th>
                    <th scope="col"><?= __('Posters Count') ?></th>
                    <th scope="col"><?= __('Backdrops Count') ?></th>
                    <th scope="col"><?= __('Reviews Count') ?></th>
                    <th scope="col"><?= __('Backdrop Path') ?></th>
                    <th scope="col"><?= __('Payload') ?></th>
                    <th scope="col"><?= __('Released') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($genre->movies as $movies): ?>
                    <tr>
                        <td><?= h($movies->id) ?></td>
                        <td><?= h($movies->title) ?></td>
                        <td><?= h($movies->tagline) ?></td>
                        <td><?= h($movies->overview) ?></td>
                        <td><?= h($movies->is_adult) ?></td>
                        <td><?= h($movies->budget) ?></td>
                        <td><?= h($movies->revenue) ?></td>
                        <td><?= h($movies->language) ?></td>
                        <td><?= h($movies->homepage) ?></td>
                        <td><?= h($movies->status) ?></td>
                        <td><?= h($movies->runtime) ?></td>
                        <td><?= h($movies->vote_count) ?></td>
                        <td><?= h($movies->popularity) ?></td>
                        <td><?= h($movies->vote_average) ?></td>
                        <td><?= h($movies->imdb_uid) ?></td>
                        <td><?= h($movies->facebook_uid) ?></td>
                        <td><?= h($movies->instagram_uid) ?></td>
                        <td><?= h($movies->twitter_uid) ?></td>
                        <td><?= h($movies->videos_count) ?></td>
                        <td><?= h($movies->posters_count) ?></td>
                        <td><?= h($movies->backdrops_count) ?></td>
                        <td><?= h($movies->reviews_count) ?></td>
                        <td><?= h($movies->backdrop_path) ?></td>
                        <td><?= h($movies->payload) ?></td>
                        <td><?= h($movies->released) ?></td>
                        <td><?= h($movies->created) ?></td>
                        <td><?= h($movies->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Movies', 'action' => 'view', $movies->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Movies', 'action' => 'edit', $movies->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Movies', 'action' => 'delete', $movies->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movies->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
