<?php
declare(strict_types=1);
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Movie[] $movies
 * @var \App\Model\Entity\Keyword[] $keywords
 * @var \App\Model\Entity\Genre[] $genres
 * @var \App\Model\Entity\Company[] $companies
 */
?>
<div class="container-fluid">
    <p></p>

    <div class="row">
        <div class="col-md-2">
            <?= $this->element('shared/card_list_options', ['title' => 'Companies', 'list' => $companies]) ?>
            <hr/>
            <?= $this->element('shared/card_list_options', ['title' => 'Genres', 'list' => $genres]) ?>
            <hr/>
            <?= $this->element('shared/card_list_options', ['title' => 'Keywords', 'list' => $keywords]) ?>
        </div>

        <div class="col-md-10">
            <?=$this->element('../Cell/MovieCards/display',compact('movies'))?>
        </div>
    </div>
</div>
