<div class="card shadow-sm">
<div class="card-body">

<h3 class="mb-4">Add New User</h3>

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
            2=>'Staff'
        ],
        'class'=>'form-select'
    ]) ?>
</div>

<div class="col-md-6 mb-3">
    <?= $this->Form->control('password', [
        'type'=>'password',
        'class'=>'form-control'
    ]) ?>
</div>

</div>

<div class="mt-3">
    <?= $this->Form->button('Create User', [
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
