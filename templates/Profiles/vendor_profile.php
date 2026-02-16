<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-person-circle me-2"></i>
                        My Profile
                    </h5>
                </div>

                <div class="card-body">

                    <?= $this->Form->create($user) ?>

                    <div class="mb-3">
                        <?= $this->Form->control('name', [
                            'class'=>'form-control'
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->control('email', [
                            'class'=>'form-control'
                        ]) ?>
                    </div>

                    <hr>

                    <h6 class="text-secondary mb-3">
                        <i class="bi bi-shield-lock me-2"></i>Change Password
                    </h6>

                    <div class="mb-3">
                        <?= $this->Form->control('current_password', [
                            'type'=>'password',
                            'class'=>'form-control',
                            'required'=>false
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->control('new_password', [
                            'type'=>'password',
                            'class'=>'form-control',
                            'required'=>false
                        ]) ?>
                    </div>

                    <div class="mb-4">
                        <?= $this->Form->control('confirm_password', [
                            'type'=>'password',
                            'class'=>'form-control',
                            'required'=>false
                        ]) ?>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">
                        <i class="bi bi-check-circle me-2"></i>Update Profile
                    </button>

                    <?= $this->Form->end() ?>

                </div>
            </div>
        </div>
    </div>
</div>
