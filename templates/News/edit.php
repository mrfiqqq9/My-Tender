<div class="card shadow-sm">
<div class="card-body">

<h3 class="mb-4">Edit News</h3>

<?= $this->Form->create($news, ['type' => 'file']) ?>

<div class="row">

    <!-- TITLE -->
    <div class="col-md-6 mb-3">
        <?= $this->Form->control('title', [
            'class' => 'form-control'
        ]) ?>
    </div>

    <!-- TENDER -->
    <div class="col-md-6 mb-3">
        <?= $this->Form->control('tender_id', [
            'options' => $tenders,
            'empty' => '-- Optional Tender --',
            'class' => 'form-select'
        ]) ?>
    </div>

    <!-- DESCRIPTION -->
    <div class="col-12 mb-3">
        <?= $this->Form->control('description', [
            'type' => 'textarea',
            'rows' => 4,
            'class' => 'form-control'
        ]) ?>
    </div>

    <!-- CURRENT IMAGE PREVIEW -->
    <?php if (!empty($news->image)): ?>
    <div class="col-md-6 mb-3">
        <label class="form-label">Current Image</label>
        <div>
            <img src="<?= $this->Url->image('img/news/' . $news->image) ?>"
                 class="img-thumbnail"
                 style="max-width:250px;max-height:180px;object-fit:cover;">
        </div>
    </div>
    <?php endif; ?>

    <!-- NEW IMAGE UPLOAD -->
    <div class="col-md-6 mb-3">
        <?= $this->Form->control('image', [
            'type' => 'file',
            'accept' => 'image/*',
            'label' => 'Change Image (optional)',
            'class' => 'form-control'
        ]) ?>
    </div>

    <!-- STATUS -->
    <div class="col-md-6 mb-3">
        <?= $this->Form->control('status', [
            'type' => 'select',
            'options' => [
                1 => 'Active',
                0 => 'Inactive'
            ],
            'class' => 'form-select'
        ]) ?>
    </div>

</div>

<hr>

<div class="mt-3">
    <?= $this->Form->button('Update News', [
        'class' => 'btn btn-success'
    ]) ?>

    <?= $this->Html->link(
        'Cancel',
        ['action' => 'index'],
        ['class' => 'btn btn-secondary ms-2']
    ) ?>
</div>

<?= $this->Form->end() ?>

</div>
</div>
