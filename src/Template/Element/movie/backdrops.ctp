<?php
declare(strict_types=1);

use App\Model\Entity\Movie;
use App\View\AppView;

/**
 * @var AppView $this
 * @var Movie $movie
 */

?>

<h2>Backdrops</h2>
<div class="container-fluid">
    <div class="row">
        <? foreach ($movie->backdrops as $backdrop): ?>
            <div class="col-md-3 pb-1">
                <?=$this->Html->image($backdrop->image_url,['class'=>'img-fluid']) ?>
            </div>
        <? endforeach; ?>
    </div>
</div>
