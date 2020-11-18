<?php
declare(strict_types=1);

use App\Model\Entity\Movie;
use App\View\AppView;

/**
 * @var AppView $this
 * @var Movie[] $movies
 */
$movie_props = [
    'Status' => 'status',
    'Popularity' => 'popularity',
    'Votes' => 'vote_count',
    'Rating' => 'vote_average',

]
?>

<div class="row row-cols-1 row-cols-md-6 row-cols-sm-4">
    <? foreach ($movies as $movie): ?>
        <div class="col">
            <div class="card movie-card">
                <?= $this->Html->image($movie->poster_image_url, [
                    'class' => 'card-img-top',
                    'alt' => $movie->title,
                    'url' => [

                    ]
                ]) ?>

                <div class="card-body">
                    <h5 class="card-title">
                        <?= $this->Html->link($movie->title, [
                            'plugin' => null,
                            'controller' => 'Movies',
                            'action' => 'view',
                            $movie->id
                        ], [
                            'class' => "stretched-link",
                            'style' => "text-decoration: none;color: inherit"
                        ]) ?>
                    </h5>
                    <p class="card-text">
                        <? foreach ($movie_props as $title => $prop): ?>
                            <? if ($value = $movie->get($prop)): ?>
                                <small class="text-muted">
                                    <b><?= $title ?>: </b>
                                    <?= is_numeric($value) ? number_format($value) : $value ?>
                                </small><br/>
                            <? endif; ?>
                        <? endforeach; ?>
                    </p>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>
