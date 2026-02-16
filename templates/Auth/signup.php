<div class="w-100">

    <h2 class="text-center mb-4 fw-bold">Create Account</h2>

    <?= $this->Flash->render() ?>

    <?= $this->Form->create($user) ?>

    <div class="mb-3">
        <?= $this->Form->label('name', 'Full Name', ['class' => 'form-label fw-semibold']) ?>
        <?= $this->Form->control('name', [
            'label' => false,
            'class' => 'form-control form-control-lg',
            'placeholder' => 'Enter your full name'
        ]) ?>
    </div>

    <div class="mb-3">
        <?= $this->Form->label('email', 'Email Address', ['class' => 'form-label fw-semibold']) ?>
        <?= $this->Form->control('email', [
            'label' => false,
            'class' => 'form-control form-control-lg',
            'placeholder' => 'Enter your email'
        ]) ?>
    </div>

    <div class="mb-4">
        <?= $this->Form->label('password', 'Password', ['class' => 'form-label fw-semibold']) ?>
        <?= $this->Form->control('password', [
            'label' => false,
            'class' => 'form-control form-control-lg',
            'placeholder' => 'Create password'
        ]) ?>
    </div>

    <div class="d-grid mb-3">
        <?= $this->Form->button('Register', [
            'class' => 'btn btn-success btn-lg'
        ]) ?>
    </div>

    <?= $this->Form->end() ?>

    <div class="text-center mt-3">
        <small>
            Already have an account?
            <?= $this->Html->link(
                'Login',
                ['action' => 'login'],
                ['class' => 'fw-bold text-decoration-none']
            ) ?>
        </small>
    </div>

</div>
