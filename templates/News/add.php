<div class="card shadow-sm">
<div class="card-body">

<h3 class="mb-4">
    <?= $news->isNew() ? 'Add News' : 'Edit News' ?>
</h3>

<?= $this->Form->create($news, ['type' => 'file']) ?>

<div class="row">

<div class="col-md-6 mb-3">
    <?= $this->Form->control('title', [
        'class'=>'form-control'
    ]) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('tender_id', [
        'options' => $tenders,
        'empty' => '-- Optional Tender --',
        'class'=>'form-select'
    ]) ?>
</div>

<div class="col-12 mb-3">
    <?= $this->Form->control('description', [
        'type'=>'textarea',
        'rows'=>4,
        'class'=>'form-control'
    ]) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('image', [
        'type'=>'file',
        'accept'=>'image/*',
        'class'=>'form-control'
    ]) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('status', [
        'type'=>'select',
        'options'=>[1=>'Active',0=>'Inactive'],
        'class'=>'form-select'
    ]) ?>
</div>

</div>

<div class="mt-3">
    <?= $this->Form->button('Save News', [
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
