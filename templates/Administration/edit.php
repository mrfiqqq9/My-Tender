<div class="container py-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="mb-4">
                <i class="bi bi-pencil-square me-2"></i>Edit Staff
            </h4>

            <?= $this->Form->create($user) ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('name', ['class'=>'form-control']) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('email', ['class'=>'form-control']) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('role', [
                        'options'=>[
                            1=>'Admin',
                            2=>'Staff'
                        ],
                        'class'=>'form-select'
                    ]) ?>
                </div>
            </div>

            <hr>

            <h5 class="mt-3">Staff Information</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('staff_name', [
                        'value'=>$staff->staff_name ?? '',
                        'class'=>'form-control'
                    ]) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('department', [
                        'value'=>$staff->department ?? '',
                        'class'=>'form-control'
                    ]) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('position', [
                        'value'=>$staff->position ?? '',
                        'class'=>'form-control'
                    ]) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('phone', [
                        'value'=>$staff->phone ?? '',
                        'class'=>'form-control'
                    ]) ?>
                </div>
            </div>

            <hr>

            <h5 class="mt-3">Reset Password</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('new_password', [
                        'type'=>'password',
                        'required'=>false,
                        'class'=>'form-control'
                    ]) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <?= $this->Form->control('confirm_password', [
                        'type'=>'password',
                        'required'=>false,
                        'class'=>'form-control'
                    ]) ?>
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-dark">
                    <i class="bi bi-check-circle me-2"></i>Update
                </button>
            </div>

            <?= $this->Form->end() ?>

        </div>
    </div>

</div>
