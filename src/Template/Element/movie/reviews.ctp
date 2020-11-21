<?php
declare(strict_types=1);

use App\Model\Entity\Movie;
use App\View\AppView;

/**
 * @var AppView $this
 * @var Movie $movie
 */

?>


<h2>Reviews</h2>
<div class="container-fluid">
    <? foreach ($movie->reviews as $review): ?>
        <div class="media">
            <? $image_url = ($review->reviewer && $review->reviewer->avatar_path) ? $review->reviewer->image_url : '/img/no-image.png' ?>
            <?= $this->Html->image($image_url, [
                'class' => 'align-self-start mr-3 img-fluid',
                'width' => 64,
                'alt' => $review->reviewer_id
            ]) ?>
            <div class="media-body">
                <? $name = $review->reviewer && $review->reviewer->name ? $review->reviewer->name : $review->reviewer_id ?>
                <h5 class="mt-0"><?= $name ?></h5>
                <?= $this->Text->autoParagraph($review->content) ?>
            </div>
        </div>
        <hr/>
    <? endforeach; ?>
</div>
