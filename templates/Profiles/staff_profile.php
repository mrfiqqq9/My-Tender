<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-header bg-dark text-white rounded-top-4">
                    <h4 class="mb-0">
                        <i class="bi bi-person-circle me-2"></i>
                        Staff / Admin Profile
                    </h4>
                </div>

                <div class="card-body p-4">

                    <?= $this->Form->create($user) ?>

                    <!-- ================= USER INFO ================= -->
                    <h5 class="mb-3 text-secondary">
                        <i class="bi bi-person me-2"></i>User Information
                    </h5>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <?= $this->Form->control('name', [
                                'class' => 'form-control',
                                'label' => 'Full Name'
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->Form->control('email', [
                                'class' => 'form-control',
                                'label' => 'Email Address'
                            ]) ?>
                        </div>
                    </div>

                    <?php if ($currentRole == 1): ?>
                        <div class="mb-4">
                            <?= $this->Form->control('role', [
                                'options'=>[
                                    1=>'Admin',
                                    2=>'Staff',
                                    3=>'Vendor'
                                ],
                                'class'=>'form-select'
                            ]) ?>
                        </div>
                    <?php endif; ?>

                    <hr>

                    <!-- ================= PASSWORD ================= -->
                    <h5 class="mb-3 text-secondary">
                        <i class="bi bi-shield-lock me-2"></i>Change Password
                    </h5>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <?= $this->Form->control('current_password', [
                                'type'=>'password',
                                'class'=>'form-control',
                                'required'=>false
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= $this->Form->control('new_password', [
                                'type'=>'password',
                                'class'=>'form-control',
                                'required'=>false
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= $this->Form->control('confirm_password', [
                                'type'=>'password',
                                'class'=>'form-control',
                                'required'=>false
                            ]) ?>
                        </div>
                    </div>

                    <hr>

                    <!-- ================= STAFF INFO ================= -->
                    <h5 class="mb-3 text-secondary">
                        <i class="bi bi-building me-2"></i>Staff Information
                    </h5>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <?= $this->Form->control('staff_name', [
                                'value'=>$staff->staff_name ?? '',
                                'class'=>'form-control'
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->Form->control('department', [
                                'value'=>$staff->department ?? '',
                                'class'=>'form-control'
                            ]) ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <?= $this->Form->control('position', [
                            'value'=>$staff->position ?? '',
                            'class'=>'form-control'
                        ]) ?>
                    </div>

                    <div class="mb-4">
                        <?= $this->Form->control('phone', [
                            'value'=>$staff->phone ?? '',
                            'class'=>'form-control'
                        ]) ?>
                    </div>

                   <button type="submit" class="btn btn-dark px-4">
    <i class="bi bi-check-circle me-2"></i> Update Profile
</button>

                    <?= $this->Form->end() ?>

                </div>
            </div>
        </div>
    </div>
</div>
