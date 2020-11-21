<?php
declare(strict_types=1);

/**
 * @var AppView $this
 * @var string $title
 * @var array $list
 */

use App\View\AppView;
use Cake\Utility\Inflector;

$modal_id = 'options_list_group__' . Inflector::variable($title);
?>
<div id="<?= $modal_id ?>_card" class="card options-card ">
    <h5 class="card-header"><?= $title ?></h5>
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#<?= $modal_id ?>_modal">
            Select <?= $title ?>
        </button>
        <ul class="list-group list-group-flush">
        </ul>
    </div>
</div>

<div class="modal fade" id="<?= $modal_id ?>_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
     aria-labelledby="<?= $modal_id ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="<?= $modal_id ?>Label"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <? foreach ($list as $id => $name): ?>
                        <li class="list-group-item" data-id="<?= $id ?>" data-name="<?= $name ?>">
                            <?= $name ?>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>

<? $this->append('script'); ?>
<script>
    $(document).ready(function () {
        let selected__<?= $modal_id ?>Items = [];

        function update<?= $modal_id ?>List() {
            let $ul = $('#<?= $modal_id ?>_card ul.list-group');
            $ul.html('');
            selected__<?= $modal_id ?>Items.forEach(function (obj) {
                $ul.append('<li class="list-group-item">' + obj.name + '</li>')
            })
        }

        $('#<?= $modal_id ?>_modal .modal-body .list-group-item').click(function () {
            let $this = $(this);
            let id = $this.data('id');
            let name = $this.data('name');
            let isSelected = $this.hasClass('active');
            if (isSelected) {
                selected__<?= $modal_id ?>Items.push({id, name});
            } else {
                selected__<?= $modal_id ?>Items = selected__<?= $modal_id ?>Items.filter(function (value) {
                    return value.id !== id;
                });
            }
            update<?= $modal_id ?>List();
        });
    });
</script>
<? $this->end() ?>
