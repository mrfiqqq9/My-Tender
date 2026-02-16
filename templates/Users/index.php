<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">User Management</h2>

    <?= $this->Html->link(
        '➕ Add User',
        ['action' => 'add'],
        ['class' => 'btn btn-primary']
    ) ?>
</div>

<!-- FILTER CARD -->
<div class="card shadow-sm mb-4">
<div class="card-body">

<?= $this->Form->create(null, ['type' => 'get', 'class'=>'row g-3']) ?>

<div class="col-md-3">
    <?= $this->Form->control('q', [
        'label' => false,
        'placeholder' => 'Search name / email',
        'class' => 'form-control'
    ]) ?>
</div>

<div class="col-md-2">
    <?= $this->Form->control('role', [
        'type' => 'select',
        'label' => false,
        'empty' => '-- All Roles --',
        'options' => [
            1 => 'Admin',
            2 => 'Staff',
            3 => 'Vendor'
        ],
        'class' => 'form-select'
    ]) ?>
</div>

<div class="col-md-2">
    <?= $this->Form->control('status', [
        'type' => 'select',
        'label' => false,
        'empty' => '-- All Status --',
        'options' => [
            1 => 'Active',
            0 => 'Suspended'
        ],
        'class' => 'form-select'
    ]) ?>
</div>

<div class="col-md-2">
    <?= $this->Form->button('Filter', [
        'class' => 'btn btn-primary w-100'
    ]) ?>
</div>

<div class="col-md-2">
    <?= $this->Html->link(
        'Reset',
        ['action' => 'index'],
        ['class' => 'btn btn-secondary w-100']
    ) ?>
</div>

<?= $this->Form->end() ?>

</div>
</div>

<!-- TABLE -->
<div class="card shadow-sm">
<div class="card-body p-0">

<table class="table table-striped table-hover align-middle mb-0">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th width="150">Action</th>
        </tr>
    </thead>
    <tbody>

<?php foreach ($users as $u): ?>
<tr>
    <td><?= $u->user_id ?></td>

    <td><?= h($u->name ?: '-') ?></td>

    <td><?= h($u->email) ?></td>

    <td>
        <?= match ($u->role) {
            1 => '<span class="badge bg-primary">Admin</span>',
            2 => '<span class="badge bg-info text-dark">Staff</span>',
            3 => '<span class="badge bg-secondary">Vendor</span>',
        } ?>
    </td>

    <td>
        <?= $u->status == 1
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-danger">Suspended</span>'
        ?>
    </td>

    <td><?= $u->created_at->format('d/m/Y') ?></td>

    <td>
        <?= $this->Html->link(
            'Edit',
            ['action' => 'edit', $u->user_id],
            ['class' => 'btn btn-sm btn-outline-success']
        ) ?>

        <?= $this->Form->postLink(
            'Delete',
            ['action' => 'delete', $u->user_id],
            [
                'confirm' => 'Are you sure?',
                'class' => 'btn btn-sm btn-outline-danger'
            ]
        ) ?>
    </td>
</tr>
<?php endforeach; ?>

<?php if ($users->count() === 0): ?>
<tr>
    <td colspan="7" class="text-center p-4">
        No users found.
    </td>
</tr>
<?php endif; ?>

    </tbody>
</table>

</div>
</div>
