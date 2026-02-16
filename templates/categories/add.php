<div class="card shadow-sm">
<div class="card-body">

<h3 class="mb-4">Add Category</h3>

<?= $this->Form->create($category) ?>

<div class="mb-3">
    <?= $this->Form->control('category_name', [
        'label'=>'Category Name',
        'class'=>'form-control'
    ]) ?>
</div>

<div class="mt-3">
    <?= $this->Form->button('Save Category', [
        'class'=>'btn btn-primary'
    ]) ?>

    <?= $this->Html->link(
        'Cancel',
        ['action'=>'index'],
        ['class'=>'btn btn-secondary ms-2']
    ) ?>
</div>

<?= $this->Form->end() ?>

</div>
</div>
