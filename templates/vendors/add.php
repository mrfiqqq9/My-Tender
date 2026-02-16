<div class="card shadow-sm">
<div class="card-body">

<h3 class="mb-4">Apply as Vendor</h3>

<?= $this->Form->create($vendor, ['type' => 'file']) ?>

<div class="row">

<!-- Company Info -->
<div class="col-md-6 mb-3">
    <?= $this->Form->control('company_name', ['class'=>'form-control']) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('ssm_number', ['class'=>'form-control']) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('years_experience', ['class'=>'form-control']) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('category_id', [
        'type'=>'select',
        'options'=>$categories,
        'empty'=>'-- Select Business Category --',
        'class'=>'form-select'
    ]) ?>
</div>

<div class="col-12 mb-3">
    <?= $this->Form->control('description', [
        'type'=>'textarea',
        'rows'=>3,
        'class'=>'form-control'
    ]) ?>
</div>

<hr class="my-4">

<h5 class="mb-3">Address</h5>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('address_line1', ['class'=>'form-control']) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('address_line2', [
        'required'=>false,
        'class'=>'form-control'
    ]) ?>
</div>

<div class="col-md-4 mb-3">
    <?= $this->Form->control('postcode', ['class'=>'form-control']) ?>
</div>

<div class="col-md-4 mb-3">
    <?= $this->Form->control('city', ['class'=>'form-control']) ?>
</div>

<div class="col-md-4 mb-3">
    <?= $this->Form->control('state', ['class'=>'form-control']) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('country', ['class'=>'form-control']) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('paid_up_capital', [
        'label'=>'Paid Up Capital (RM)',
        'class'=>'form-control'
    ]) ?>
</div>

<hr class="my-4">

<h5 class="mb-3">Documents (PDF Only)</h5>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('ssm_file', [
        'type'=>'file',
        'accept'=>'application/pdf',
        'class'=>'form-control'
    ]) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('tcc_file', [
        'type'=>'file',
        'accept'=>'application/pdf',
        'class'=>'form-control'
    ]) ?>
</div>

</div>

<div class="mt-3">
    <?= $this->Form->button('Submit Application', [
        'class'=>'btn btn-primary'
    ]) ?>
</div>

<?= $this->Form->end() ?>

</div>
</div>
