<?php
declare(strict_types=1);

use App\View\AppView;

/**
 * @var AppView $this
 */

$nav_links = $nav_links ?? [];
foreach ($nav_links as $name => $url_parts) {
    $url = $this->Url->build($url_parts);
    $active = $this->getRequest()->getRequestTarget() === $url
        ? 'active'
        : '';
    ?>

    <li class="nav-item <?= $active ?>">
        <?= $this->Html->link($name, $url, ['class' => 'nav-link']) ?>
    </li>
<?php } ?>
