<?php $this->extend('../Layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('New Movie'), ['action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Videos'), ['controller' => 'Videos', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Video'), ['controller' => 'Videos', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Casts'), ['controller' => 'Casts', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Cast'), ['controller' => 'Casts', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Crews'), ['controller' => 'Crews', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Crew'), ['controller' => 'Crews', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Reviews'), ['controller' => 'Reviews', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Review'), ['controller' => 'Reviews', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Movie Posters'), ['controller' => 'MoviePosters', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Movie Poster'), ['controller' => 'MoviePosters', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Movie Backdrops'), ['controller' => 'MovieBackdrops', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Movie Backdrop'), ['controller' => 'MovieBackdrops', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Genres'), ['controller' => 'Genres', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Genre'), ['controller' => 'Genres', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Keywords'), ['controller' => 'Keywords', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Keyword'), ['controller' => 'Keywords', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Production Companies'), ['controller' => 'Companies', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Production Company'), ['controller' => 'Companies', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('title') ?></th>
        <th scope="col"><?= $this->Paginator->sort('tagline') ?></th>
        <th scope="col"><?= $this->Paginator->sort('backdrop_path') ?></th>
        <th scope="col"><?= $this->Paginator->sort('poster_path') ?></th>
        <th scope="col"><?= $this->Paginator->sort('is_adult') ?></th>
        <th scope="col"><?= $this->Paginator->sort('budget') ?></th>
        <th scope="col"><?= $this->Paginator->sort('revenue') ?></th>
        <th scope="col"><?= $this->Paginator->sort('language') ?></th>
        <th scope="col"><?= $this->Paginator->sort('homepage') ?></th>
        <th scope="col"><?= $this->Paginator->sort('status') ?></th>
        <th scope="col"><?= $this->Paginator->sort('runtime') ?></th>
        <th scope="col"><?= $this->Paginator->sort('vote_count') ?></th>
        <th scope="col"><?= $this->Paginator->sort('popularity') ?></th>
        <th scope="col"><?= $this->Paginator->sort('vote_average') ?></th>
        <th scope="col"><?= $this->Paginator->sort('imdb_uid') ?></th>
        <th scope="col"><?= $this->Paginator->sort('facebook_uid') ?></th>
        <th scope="col"><?= $this->Paginator->sort('instagram_uid') ?></th>
        <th scope="col"><?= $this->Paginator->sort('twitter_uid') ?></th>
        <th scope="col"><?= $this->Paginator->sort('videos_count') ?></th>
        <th scope="col"><?= $this->Paginator->sort('posters_count') ?></th>
        <th scope="col"><?= $this->Paginator->sort('backdrops_count') ?></th>
        <th scope="col"><?= $this->Paginator->sort('reviews_count') ?></th>
        <th scope="col"><?= $this->Paginator->sort('payload') ?></th>
        <th scope="col"><?= $this->Paginator->sort('released') ?></th>
        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($movies as $movie): ?>
        <tr>
            <td><?= $this->Number->format($movie->id) ?></td>
            <td><?= h($movie->title) ?></td>
            <td><?= h($movie->tagline) ?></td>
            <td><?= h($movie->backdrop_path) ?></td>
            <td><?= h($movie->poster_path) ?></td>
            <td><?= h($movie->is_adult) ?></td>
            <td><?= $this->Number->format($movie->budget) ?></td>
            <td><?= $this->Number->format($movie->revenue) ?></td>
            <td><?= h($movie->language) ?></td>
            <td><?= h($movie->homepage) ?></td>
            <td><?= h($movie->status) ?></td>
            <td><?= $this->Number->format($movie->runtime) ?></td>
            <td><?= $this->Number->format($movie->vote_count) ?></td>
            <td><?= $this->Number->format($movie->popularity) ?></td>
            <td><?= $this->Number->format($movie->vote_average) ?></td>
            <td><?= h($movie->imdb_uid) ?></td>
            <td><?= h($movie->facebook_uid) ?></td>
            <td><?= h($movie->instagram_uid) ?></td>
            <td><?= h($movie->twitter_uid) ?></td>
            <td><?= $this->Number->format($movie->videos_count) ?></td>
            <td><?= $this->Number->format($movie->posters_count) ?></td>
            <td><?= $this->Number->format($movie->backdrops_count) ?></td>
            <td><?= $this->Number->format($movie->reviews_count) ?></td>
            <td><?= h($movie->payload) ?></td>
            <td><?= h($movie->released) ?></td>
            <td><?= h($movie->created) ?></td>
            <td><?= h($movie->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $movie->id], ['title' => __('View'), 'class' => 'btn btn-secondary']) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $movie->id], ['title' => __('Edit'), 'class' => 'btn btn-secondary']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $movie->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movie->id), 'title' => __('Delete'), 'class' => 'btn btn-danger']) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('First')) ?>
        <?= $this->Paginator->prev('< ' . __('Previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('Next') . ' >') ?>
        <?= $this->Paginator->last(__('Last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
</div>
