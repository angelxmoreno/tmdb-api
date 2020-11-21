<?php
declare(strict_types=1);

use App\Model\Entity\Movie;
use App\View\AppView;

/**
 * @var AppView $this
 * @var Movie $movie
 */

?>

<h2>Cast</h2>
<div class="container-fluid">
    <div class="row row-cols-1 row-cols-xl-6 row-cols-lg-4 row-cols-md-3">
        <? foreach ($movie->casts as $cast): ?>
            <div class="col">
                <div class="card mb-1">
                    <? $image_url = ($cast->person && $cast->person->profile_path) ? $cast->person->image_url : '/img/no-image.png' ?>
                    <?= $this->Html->image($image_url, [
                        'class' => 'card-img-top',
                        'alt' => $cast->person->name
                    ]) ?>

                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $this->Html->link($cast->person->name, [
                                'plugin' => null,
                                'controller' => 'People',
                                'action' => 'view',
                                $cast->person->id
                            ], [
                                'class' => "stretched-link",
                                'style' => "text-decoration: none;color: inherit"
                            ]) ?>
                        </h5>
                        <p class="card-text">
                            <small class="text-muted">
                                <b>As <?= $cast->name ?></b>
                            </small><br/>
                        </p>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>
