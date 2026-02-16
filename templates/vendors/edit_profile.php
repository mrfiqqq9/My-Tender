<div class="card shadow-sm">
<div class="card-body">

<h3 class="mb-4">Edit Vendor Profile</h3>

<?= $this->Form->create($vendor) ?>

<div class="row">

<div class="col-md-6 mb-3">
    <?= $this->Form->control('company_name', ['class'=>'form-control']) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('category_id', [
        'type'=>'select',
        'options'=>$categories,
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

<div class="col-md-6 mb-3">
    <?= $this->Form->control('years_experience', ['class'=>'form-control']) ?>
</div>

<hr class="my-3">

<h5>Address</h5>

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
        'class'=>'form-control'
    ]) ?>
</div>

</div>

<div class="mt-3">
    <?= $this->Form->button('Update Profile', [
        'class'=>'btn btn-success'
    ]) ?>
</div>

<?= $this->Form->end() ?>

</div>
</div>
