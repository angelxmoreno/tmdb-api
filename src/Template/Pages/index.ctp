<?php
declare(strict_types=1);

use App\View\AppView;

/**
 * @var AppView $this
 */

?>

<div class="container">
    <?= $this->cell('MovieSlider', ['limit' => 10], ['cache' => true])->render(); ?>
</div>

<h2>Top Rated</h2>
<?= $this->cell('MovieCards', ['limit' => 5], ['cache' => true])->render(); ?>
