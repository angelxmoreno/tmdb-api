<?php $this->extend('../Layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $movie->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movie->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Movies'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
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

<div class="movies form content">
    <?= $this->Form->create($movie) ?>
    <fieldset>
        <legend><?= __('Edit Movie') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('tagline');
            echo $this->Form->control('overview');
            echo $this->Form->control('is_adult');
            echo $this->Form->control('budget');
            echo $this->Form->control('revenue');
            echo $this->Form->control('language');
            echo $this->Form->control('homepage');
            echo $this->Form->control('status');
            echo $this->Form->control('runtime');
            echo $this->Form->control('vote_count');
            echo $this->Form->control('popularity');
            echo $this->Form->control('vote_average');
            echo $this->Form->control('imdb_uid');
            echo $this->Form->control('facebook_uid');
            echo $this->Form->control('instagram_uid');
            echo $this->Form->control('twitter_uid');
            echo $this->Form->control('videos_count');
            echo $this->Form->control('posters_count');
            echo $this->Form->control('backdrops_count');
            echo $this->Form->control('reviews_count');
            echo $this->Form->control('backdrop_path');
            echo $this->Form->control('payload');
            echo $this->Form->control('released', ['empty' => true]);
            echo $this->Form->control('genres._ids', ['options' => $genres]);
            echo $this->Form->control('keywords._ids', ['options' => $keywords]);
            echo $this->Form->control('production_companies._ids', ['options' => $productionCompanies]);
                ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
