<?php
declare(strict_types=1);

use App\Model\Entity\Movie;
use App\View\AppView;

/**
 * @var AppView $this
 * @var Movie[] $movies
 */

?>
<div class="card-group">
    <? foreach ($movies as $movie): ?>
        <div class="card">
            <img src="<?= $movie->poster_image_url ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $movie->title ?></h5>
                <p class="card-text"><small class="text-muted">Status: <?= $movie->status ?></small></p>
            </div>
        </div>
    <? endforeach; ?>
</div>
