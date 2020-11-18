<?php
declare(strict_types=1);

use App\Model\Entity\Movie;
use App\View\AppView;

/**
 * @var AppView $this
 * @var Movie $movie
 */

?>


<h2>Videos</h2>
<div class="container-fluid">
    <div class="row">
        <? foreach ($movie->videos as $video): ?>
            <div class="col-md-4 pb-1">
                <div class="embed-responsive embed-responsive-4by3">
                    <?= $this->VideoWidget->renderVideo($video) ?>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>
