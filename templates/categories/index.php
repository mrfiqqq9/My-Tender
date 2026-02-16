<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Categories</h2>

    <?php if ($role === 1): ?>
        <?= $this->Html->link(
            '➕ Add Category',
            ['action' => 'add'],
            ['class' => 'btn btn-primary']
        ) ?>
    <?php endif; ?>
</div>

<!-- SEARCH CARD -->
<div class="card shadow-sm mb-4">
<div class="card-body">

<form method="get" class="row g-3">

<div class="col-md-4">
    <input
        type="text"
        name="q"
        placeholder="Search category..."
        value="<?= h($q ?? '') ?>"
        class="form-control"
    >
</div>

<div class="col-md-2">
    <button class="btn btn-primary w-100">
        Search
    </button>
</div>

<div class="col-md-2">
    <a href="<?= $this->Url->build(['action' => 'index']) ?>"
       class="btn btn-secondary w-100">
       Reset
    </a>
</div>

</form>

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
    <?php if ($role === 1): ?>
        <th width="160">Action</th>
    <?php endif; ?>
</tr>
</thead>

<tbody>
<?php foreach ($categories as $c): ?>
<tr>
    <td><?= $c->category_id ?></td>
    <td><?= h($c->category_name) ?></td>

    <?php if ($role === 1): ?>
    <td>
        <?= $this->Html->link(
            'Edit',
            ['action'=>'edit',$c->category_id],
            ['class'=>'btn btn-sm btn-outline-success']
        ) ?>

        <?= $this->Form->postLink(
            'Delete',
            ['action'=>'delete',$c->category_id],
            [
                'confirm'=>'Delete this category?',
                'class'=>'btn btn-sm btn-outline-danger'
            ]
        ) ?>
    </td>
    <?php endif; ?>
</tr>
<?php endforeach; ?>

<?php if ($categories->count() === 0): ?>
<tr>
    <td colspan="<?= $role === 1 ? 3 : 2 ?>"
        class="text-center p-4">
        No categories found.
    </td>
</tr>
<?php endif; ?>

</tbody>
</table>

</div>
</div>
