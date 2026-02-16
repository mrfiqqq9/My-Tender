<div class="w-100">

    <h2 class="text-center mb-4 fw-bold">Login</h2>

    <?= $this->Flash->render() ?>

    <?= $this->Form->create(null, ['class' => 'needs-validation']) ?>

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
            'placeholder' => 'Enter your password'
        ]) ?>
    </div>

    <div class="d-grid mb-3">
        <?= $this->Form->button('Login', [
            'class' => 'btn btn-primary btn-lg'
        ]) ?>
    </div>

    <?= $this->Form->end() ?>

    <div class="text-center mt-3">
        <small>
            Don’t have an account?
            <?= $this->Html->link(
                'Sign Up',
                ['action' => 'signup'],
                ['class' => 'fw-bold text-decoration-none']
            ) ?>
        </small>
    </div>

</div>
