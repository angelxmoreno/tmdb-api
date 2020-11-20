<?php
declare(strict_types=1);

use App\Model\Entity\Movie;
use App\View\AppView;

/**
 * @var AppView $this
 * @var Movie $movie
 */
$first_tab_title = 'Crew';
$tabs = [
    'Info' => 'basic_info',
    'Videos'=>'videos',
    'Posters'=>'posters',
    'Backdrops'=>'backdrops',
    'Cast'=>'casts',
    'Crew'=>'crews',
    'Reviews'=>'basic_info',
    'Production Companies'=>'basic_info',
];
?>
<div class="container hidden">
    <div class="row">
        <div class="col-md-12">
            <h1><?= h($movie->title) ?> <small><?= h($movie->tagline) ?></small></h1>
        </div>
        <div class="col">
            <?= $this->Html->image($movie->poster_image_url, ['class' => 'img-fluid']) ?>
        </div>
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <td colspan="2"><?= h($movie->overview) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Language') ?></th>
                        <td><?= $this->Text->autoParagraph($movie->language) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Budget') ?></th>
                        <td><?= $this->Number->currency($movie->budget) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Revenue') ?></th>
                        <td><?= $this->Number->currency($movie->revenue) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Runtime') ?></th>
                        <td><?= $this->Number->format($movie->runtime) ?> minutes</td>
                    </tr>

                    <tr>
                        <th scope="row"><?= __('Status') ?></th>
                        <td><?= h($movie->status) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Released') ?></th>
                        <td><?=$movie->released?$movie->released->nice():'Unknown' ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Vote Count') ?></th>
                        <td><?= $this->Number->format($movie->vote_count) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Popularity') ?></th>
                        <td><?= $this->Number->format($movie->popularity) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Vote Average') ?></th>
                        <td><?= $this->Number->format($movie->vote_average) ?></td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
    <hr/>
</div>
<div class="container-fluid">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <? foreach ($tabs as $title => $element): ?>
            <li class="nav-item" role="presentation">
                <a
                    id="movie_<?=$element?>-tab"
                    data-toggle="tab"
                    href="#<?=$element?>"
                    aria-controls="movie_<?=$element?>" aria-selected="<?= $first_tab_title === $title ? 'true' : 'false' ?>"
                    class="nav-link<?= $first_tab_title === $title ? ' active' : '' ?>"
                >
                    <?= $title ?>
                </a>
            </li>
        <? endforeach; ?>
    </ul>
    <div class="tab-content" id="myTabContent">
        <p/>
        <? foreach ($tabs as $title => $element): ?>
            <div class="tab-pane fade<?= $first_tab_title === $title ? ' show active' : '' ?>" id="<?=$element?>" role="tabpanel" aria-labelledby="movie_<?=$element?>-tab">
                <?=$this->element('movie/'.$element, compact('movie'))?>
            </div>
        <? endforeach; ?>
    </div>
</div>
