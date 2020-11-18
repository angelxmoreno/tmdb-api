<?php
declare(strict_types=1);

use App\View\AppView;

/**
 * @var AppView $this
 */

$poster_rows = [
    'Popular' => 'popular',
    'Top Rated' => 'topRated',
    'Upcoming' => 'upcoming',
    'Top Viewed' => 'topViewed',
];
$limit = 6;
?>

<div class="container">
    <?= $this->cell('MovieSlider', ['limit' => 10], [
        'cache' => ['key' => 'MovieSlider']
    ])->render(); ?>
</div>
<? foreach ($poster_rows as $title => $query): ?>
    <h2><?= $title ?> Movies</h2>
    <?= $this->cell('MovieCards', compact('limit', 'query'), [
        'cache' => ['key' => 'MovieCards_2' . $query]
    ])->render(); ?>
<? endforeach; ?>
