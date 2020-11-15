<?php $this->extend('../Layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Edit Movie'), ['action' => 'edit', $movie->id], ['class' => 'nav-link']) ?></li>
<li><?= $this->Form->postLink( __('Delete Movie'), ['action' => 'delete', $movie->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movie->id), 'class' => 'nav-link'] ) ?></li>
<li><?= $this->Html->link(__('List Movies'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('New Movie'), ['action' => 'add'], ['class' => 'nav-link']) ?> </li>
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

<div class="movies view large-9 medium-8 columns content">
    <h3><?= h($movie->name) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('Title') ?></th>
                <td><?= h($movie->title) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Tagline') ?></th>
                <td><?= h($movie->tagline) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Language') ?></th>
                <td><?= h($movie->language) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Homepage') ?></th>
                <td><?= h($movie->homepage) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Status') ?></th>
                <td><?= h($movie->status) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Imdb Uid') ?></th>
                <td><?= h($movie->imdb_uid) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Facebook Uid') ?></th>
                <td><?= h($movie->facebook_uid) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Instagram Uid') ?></th>
                <td><?= h($movie->instagram_uid) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Twitter Uid') ?></th>
                <td><?= h($movie->twitter_uid) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Backdrop Path') ?></th>
                <td><?= h($movie->backdrop_path) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Payload') ?></th>
                <td><?= h($movie->payload) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($movie->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Budget') ?></th>
                <td><?= $this->Number->format($movie->budget) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Revenue') ?></th>
                <td><?= $this->Number->format($movie->revenue) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Runtime') ?></th>
                <td><?= $this->Number->format($movie->runtime) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Vote Count') ?></th>
                <td><?= $this->Number->format($movie->vote_count) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Popularity') ?></th>
                <td><?= $this->Number->format($movie->popularity) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Vote Average') ?></th>
                <td><?= $this->Number->format($movie->vote_average) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Videos Count') ?></th>
                <td><?= $this->Number->format($movie->videos_count) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Posters Count') ?></th>
                <td><?= $this->Number->format($movie->posters_count) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Backdrops Count') ?></th>
                <td><?= $this->Number->format($movie->backdrops_count) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Reviews Count') ?></th>
                <td><?= $this->Number->format($movie->reviews_count) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Released') ?></th>
                <td><?= h($movie->released) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($movie->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($movie->modified) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Is Adult') ?></th>
                <td><?= $movie->is_adult ? __('Yes') : __('No'); ?></td>
            </tr>
        </table>
    </div>
    <div class="row">
        <h4><?= __('Overview') ?></h4>
        <?= $this->Text->autoParagraph(h($movie->overview)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Genres') ?></h4>
        <?php if (!empty($movie->genres)): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($movie->genres as $genres): ?>
                <tr>
                    <td><?= h($genres->id) ?></td>
                    <td><?= h($genres->name) ?></td>
                    <td><?= h($genres->created) ?></td>
                    <td><?= h($genres->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Genres', 'action' => 'view', $genres->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Genres', 'action' => 'edit', $genres->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Form->postLink( __('Delete'), ['controller' => 'Genres', 'action' => 'delete', $genres->id], ['confirm' => __('Are you sure you want to delete # {0}?', $genres->id), 'class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Keywords') ?></h4>
        <?php if (!empty($movie->keywords)): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($movie->keywords as $keywords): ?>
                <tr>
                    <td><?= h($keywords->id) ?></td>
                    <td><?= h($keywords->name) ?></td>
                    <td><?= h($keywords->created) ?></td>
                    <td><?= h($keywords->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Keywords', 'action' => 'view', $keywords->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Keywords', 'action' => 'edit', $keywords->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Form->postLink( __('Delete'), ['controller' => 'Keywords', 'action' => 'delete', $keywords->id], ['confirm' => __('Are you sure you want to delete # {0}?', $keywords->id), 'class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Companies') ?></h4>
        <?php if (!empty($movie->production_companies)): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('Logo Path') ?></th>
                    <th scope="col"><?= __('Origin Country') ?></th>
                    <th scope="col"><?= __('Payload') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($movie->production_companies as $productionCompanies): ?>
                <tr>
                    <td><?= h($productionCompanies->id) ?></td>
                    <td><?= h($productionCompanies->name) ?></td>
                    <td><?= h($productionCompanies->logo_path) ?></td>
                    <td><?= h($productionCompanies->origin_country) ?></td>
                    <td><?= h($productionCompanies->payload) ?></td>
                    <td><?= h($productionCompanies->created) ?></td>
                    <td><?= h($productionCompanies->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Companies', 'action' => 'view', $productionCompanies->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Companies', 'action' => 'edit', $productionCompanies->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Form->postLink( __('Delete'), ['controller' => 'Companies', 'action' => 'delete', $productionCompanies->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productionCompanies->id), 'class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Videos') ?></h4>
        <?php if (!empty($movie->videos)): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Movie Id') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('Iso 639 1') ?></th>
                    <th scope="col"><?= __('Iso 3166 1') ?></th>
                    <th scope="col"><?= __('Site Uid') ?></th>
                    <th scope="col"><?= __('Site') ?></th>
                    <th scope="col"><?= __('Size') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($movie->videos as $videos): ?>
                <tr>
                    <td><?= h($videos->id) ?></td>
                    <td><?= h($videos->movie_id) ?></td>
                    <td><?= h($videos->name) ?></td>
                    <td><?= h($videos->iso_639_1) ?></td>
                    <td><?= h($videos->iso_3166_1) ?></td>
                    <td><?= h($videos->site_uid) ?></td>
                    <td><?= h($videos->site) ?></td>
                    <td><?= h($videos->size) ?></td>
                    <td><?= h($videos->created) ?></td>
                    <td><?= h($videos->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Videos', 'action' => 'view', $videos->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Videos', 'action' => 'edit', $videos->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Form->postLink( __('Delete'), ['controller' => 'Videos', 'action' => 'delete', $videos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $videos->id), 'class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Casts') ?></h4>
        <?php if (!empty($movie->casts)): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Movie Id') ?></th>
                    <th scope="col"><?= __('Person Id') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('Cast Uid') ?></th>
                    <th scope="col"><?= __('Position') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($movie->casts as $casts): ?>
                <tr>
                    <td><?= h($casts->id) ?></td>
                    <td><?= h($casts->movie_id) ?></td>
                    <td><?= h($casts->person_id) ?></td>
                    <td><?= h($casts->name) ?></td>
                    <td><?= h($casts->cast_uid) ?></td>
                    <td><?= h($casts->position) ?></td>
                    <td><?= h($casts->created) ?></td>
                    <td><?= h($casts->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Casts', 'action' => 'view', $casts->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Casts', 'action' => 'edit', $casts->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Form->postLink( __('Delete'), ['controller' => 'Casts', 'action' => 'delete', $casts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $casts->id), 'class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Crews') ?></h4>
        <?php if (!empty($movie->crews)): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Movie Id') ?></th>
                    <th scope="col"><?= __('Person Id') ?></th>
                    <th scope="col"><?= __('Job') ?></th>
                    <th scope="col"><?= __('Department') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($movie->crews as $crews): ?>
                <tr>
                    <td><?= h($crews->id) ?></td>
                    <td><?= h($crews->movie_id) ?></td>
                    <td><?= h($crews->person_id) ?></td>
                    <td><?= h($crews->job) ?></td>
                    <td><?= h($crews->department) ?></td>
                    <td><?= h($crews->created) ?></td>
                    <td><?= h($crews->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Crews', 'action' => 'view', $crews->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Crews', 'action' => 'edit', $crews->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Form->postLink( __('Delete'), ['controller' => 'Crews', 'action' => 'delete', $crews->id], ['confirm' => __('Are you sure you want to delete # {0}?', $crews->id), 'class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Reviews') ?></h4>
        <?php if (!empty($movie->reviews)): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Movie Id') ?></th>
                    <th scope="col"><?= __('Reviewer Id') ?></th>
                    <th scope="col"><?= __('Url') ?></th>
                    <th scope="col"><?= __('Content') ?></th>
                    <th scope="col"><?= __('Iso 639 1') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($movie->reviews as $reviews): ?>
                <tr>
                    <td><?= h($reviews->id) ?></td>
                    <td><?= h($reviews->movie_id) ?></td>
                    <td><?= h($reviews->reviewer_id) ?></td>
                    <td><?= h($reviews->url) ?></td>
                    <td><?= h($reviews->content) ?></td>
                    <td><?= h($reviews->iso_639_1) ?></td>
                    <td><?= h($reviews->created) ?></td>
                    <td><?= h($reviews->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Reviews', 'action' => 'view', $reviews->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Reviews', 'action' => 'edit', $reviews->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Form->postLink( __('Delete'), ['controller' => 'Reviews', 'action' => 'delete', $reviews->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reviews->id), 'class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Movie Posters') ?></h4>
        <?php if (!empty($movie->posters)): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Foreign Model') ?></th>
                    <th scope="col"><?= __('Foreign Uid') ?></th>
                    <th scope="col"><?= __('Type') ?></th>
                    <th scope="col"><?= __('File Path') ?></th>
                    <th scope="col"><?= __('Height') ?></th>
                    <th scope="col"><?= __('Width') ?></th>
                    <th scope="col"><?= __('Vote Count') ?></th>
                    <th scope="col"><?= __('Vote Average') ?></th>
                    <th scope="col"><?= __('Iso 639 1') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($movie->posters as $moviePosters): ?>
                <tr>
                    <td><?= h($moviePosters->id) ?></td>
                    <td><?= h($moviePosters->foreign_model) ?></td>
                    <td><?= h($moviePosters->foreign_uid) ?></td>
                    <td><?= h($moviePosters->type) ?></td>
                    <td><?= h($moviePosters->file_path) ?></td>
                    <td><?= h($moviePosters->height) ?></td>
                    <td><?= h($moviePosters->width) ?></td>
                    <td><?= h($moviePosters->vote_count) ?></td>
                    <td><?= h($moviePosters->vote_average) ?></td>
                    <td><?= h($moviePosters->iso_639_1) ?></td>
                    <td><?= h($moviePosters->created) ?></td>
                    <td><?= h($moviePosters->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'MoviePosters', 'action' => 'view', $moviePosters->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'MoviePosters', 'action' => 'edit', $moviePosters->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Form->postLink( __('Delete'), ['controller' => 'MoviePosters', 'action' => 'delete', $moviePosters->id], ['confirm' => __('Are you sure you want to delete # {0}?', $moviePosters->id), 'class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Movie Backdrops') ?></h4>
        <?php if (!empty($movie->backdrops)): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Foreign Model') ?></th>
                    <th scope="col"><?= __('Foreign Uid') ?></th>
                    <th scope="col"><?= __('Type') ?></th>
                    <th scope="col"><?= __('File Path') ?></th>
                    <th scope="col"><?= __('Height') ?></th>
                    <th scope="col"><?= __('Width') ?></th>
                    <th scope="col"><?= __('Vote Count') ?></th>
                    <th scope="col"><?= __('Vote Average') ?></th>
                    <th scope="col"><?= __('Iso 639 1') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($movie->backdrops as $movieBackdrops): ?>
                <tr>
                    <td><?= h($movieBackdrops->id) ?></td>
                    <td><?= h($movieBackdrops->foreign_model) ?></td>
                    <td><?= h($movieBackdrops->foreign_uid) ?></td>
                    <td><?= h($movieBackdrops->type) ?></td>
                    <td><?= h($movieBackdrops->file_path) ?></td>
                    <td><?= h($movieBackdrops->height) ?></td>
                    <td><?= h($movieBackdrops->width) ?></td>
                    <td><?= h($movieBackdrops->vote_count) ?></td>
                    <td><?= h($movieBackdrops->vote_average) ?></td>
                    <td><?= h($movieBackdrops->iso_639_1) ?></td>
                    <td><?= h($movieBackdrops->created) ?></td>
                    <td><?= h($movieBackdrops->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'MovieBackdrops', 'action' => 'view', $movieBackdrops->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'MovieBackdrops', 'action' => 'edit', $movieBackdrops->id], ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Form->postLink( __('Delete'), ['controller' => 'MovieBackdrops', 'action' => 'delete', $movieBackdrops->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movieBackdrops->id), 'class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
