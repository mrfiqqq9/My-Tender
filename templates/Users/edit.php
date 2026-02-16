<div class="card shadow-sm">
<div class="card-body">

<h3 class="mb-4">Edit User</h3>

<?= $this->Form->create($user) ?>

<div class="row">

<div class="col-md-6 mb-3">
    <?= $this->Form->control('name', [
        'class'=>'form-control'
    ]) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('email', [
        'class'=>'form-control'
    ]) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('role', [
        'type'=>'select',
        'options'=>[
            1=>'Admin',
            2=>'Staff',
            3=>'Vendor'
        ],
        'class'=>'form-select'
    ]) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('status', [
        'type'=>'select',
        'options'=>[
            1=>'Active',
            0=>'Suspended'
        ],
        'class'=>'form-select'
    ]) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('password', [
        'type'=>'password',
        'required'=>false,
        'label'=>'New Password (leave blank to keep)',
        'class'=>'form-control'
    ]) ?>
</div>

</div>

<hr>

<div class="mt-3">
    <?= $this->Form->button('Update User', [
        'class'=>'btn btn-success'
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
