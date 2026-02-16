<div class="card shadow-sm">
<div class="card-body">

<h3 class="mb-4">Apply for Tender</h3>

<?= $this->Form->create($application, ['type'=>'file']) ?>

<div class="row">

<div class="col-md-6 mb-3">
    <?= $this->Form->control('proposed_price', [
        'label'=>'Proposed Price (RM)',
        'class'=>'form-control'
    ]) ?>
</div>

<div class="col-12 mb-3">
    <?= $this->Form->control('proposal_description', [
        'type'=>'textarea',
        'rows'=>4,
        'class'=>'form-control'
    ]) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('quotation_file', [
        'type'=>'file',
        'label'=>'Upload Quotation (PDF only)',
        'accept'=>'application/pdf',
        'class'=>'form-control'
    ]) ?>
</div>

</div>

<?= $this->Form->button('Submit Application', [
    'class'=>'btn btn-primary'
]) ?>

<?= $this->Form->end() ?>

</div>
</div>
