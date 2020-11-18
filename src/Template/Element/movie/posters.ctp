<?php
declare(strict_types=1);

use App\Model\Entity\Movie;
use App\View\AppView;

/**
 * @var AppView $this
 * @var Movie $movie
 */

?>

<h2>Posters</h2>
<div class="container-fluid">
    <div class="row">
        <? foreach ($movie->posters as $poster): ?>
            <div class="col-md-2 pb-1">
                <?=$this->Html->image($poster->image_url,['class'=>'img-fluid']) ?>
            </div>
        <? endforeach; ?>
    </div>
</div>
