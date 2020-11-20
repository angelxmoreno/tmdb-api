<?php
declare(strict_types=1);

use App\Model\Entity\Movie;
use App\View\AppView;

/**
 * @var AppView $this
 * @var Movie $movie
 */
$social_accounts = [
    [
        'title' => 'Home Page',
        'prop' => 'homepage',
        'format' => '%s'
    ],
    [
        'title' => 'TMDB',
        'prop' => 'id',
        'format' => 'https://www.themoviedb.org/movie/%s'
    ],
    [
        'title' => 'IMDB',
        'prop' => 'imdb_uid',
        'format' => 'https://www.imdb.com/title/%s/'
    ],
    [
        'title' => 'Facebook',
        'prop' => 'facebook_uid',
        'format' => 'https://www.facebook.com/%s/'
    ],
    [
        'title' => 'Twitter',
        'prop' => 'twitter_uid',
        'format' => 'https://twitter.com/%s'
    ],
    [
        'title' => 'Instagram',
        'prop' => 'instagram_uid',
        'format' => 'https://www.instagram.com/%s/'
    ],
]
?>

<? if ($keywords = $movie->keywords): ?>
    <h2>Keywords</h2>
    <? foreach ($keywords as $keyword): ?>
        <span class="badge badge-pill badge-primary"><?= $keyword->name ?></span>
    <? endforeach; ?>
<? endif; ?>
<? if ($genres = $movie->genres): ?>
    <h2>Genres</h2>
    <? foreach ($genres as $genre): ?>
        <span class="badge badge-pill badge-success"><?= $genre->name ?></span>
    <? endforeach; ?>
<? endif; ?>
<h2>Social</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <? foreach ($social_accounts as $social): ?>
            <? if ($value = $movie->get($social['prop'])): ?>
                <tr>
                    <th scope="row"><?= $social['title'] ?></th>
                    <td><?= $this->Html->link(sprintf($social['format'], $value)) ?></td>
                </tr>
            <? endif; ?>
        <? endforeach; ?>
    </table>
</div>
