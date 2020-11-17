<?php
declare(strict_types=1);

use App\Model\Entity\Movie;
use App\View\AppView;

/**
 * @var AppView $this
 * @var Movie[] $movies
 */

?>
<div id="movieCarousel" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <? foreach ($movies as $index => $movie): ?>
            <li data-target="#movieCarousel" data-slide-to="<?= $index ?>"
                class="<?= $index === 0 ? 'active' : '' ?>"></li>
        <? endforeach; ?>
    </ol>
    <div class="carousel-inner">

        <? foreach ($movies as $index => $movie): ?>
            <div class="carousel-item<?= $index === 0 ? ' active' : '' ?>">
                <img src="<?= $movie->backdrop_image_url ?>" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>
                        <?= $this->Html->link($movie->title, [
                            'plugin' => null,
                            'controller' => 'Movies',
                            'action' => 'view',
                            $movie->id
                        ], ['style' => 'text-decoration:none; color:white']) ?>
                    </h5>
                    <p><?= $movie->tagline ?></p>
                </div>
            </div>
        <? endforeach; ?>

    </div>
    <a class="carousel-control-prev" href="#movieCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#movieCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
