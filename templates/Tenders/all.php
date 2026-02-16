<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">All Tenders</h2>

    <div>
        <?= $this->Html->link(
            '← Back to Active',
            ['action'=>'index'],
            ['class'=>'btn btn-outline-secondary me-2']
        ) ?>

        <?= $this->Html->link(
            '➕ Add Tender',
            ['action'=>'add'],
            ['class'=>'btn btn-primary']
        ) ?>
    </div>
</div>


<!-- ================= FILTER CARD ================= -->
<div class="card shadow-sm mb-4">
<div class="card-body">

<?= $this->Form->create(null, ['type'=>'get','class'=>'row g-3 align-items-end']) ?>

<div class="col-md-4">
    <?= $this->Form->control('q', [
        'label'=>'Search',
        'placeholder'=>'Search tender title...',
        'value'=>$q ?? '',
        'class'=>'form-control'
    ]) ?>
</div>

<div class="col-md-3">
    <?= $this->Form->control('status', [
        'type'=>'select',
        'label'=>'Status',
        'empty'=>'-- All Status --',
        'options'=>[
            1 => 'Active',
            0 => 'Archived'
        ],
        'value'=>$status ?? '',
        'class'=>'form-select'
    ]) ?>
</div>

<div class="col-md-2">
    <?= $this->Form->button('Filter', [
        'class'=>'btn btn-primary w-100'
    ]) ?>
</div>

<div class="col-md-2">
    <?= $this->Html->link(
        'Reset',
        ['action'=>'all'],
        ['class'=>'btn btn-outline-secondary w-100']
    ) ?>
</div>

<?= $this->Form->end() ?>

</div>
</div>


<!-- ================= TABLE ================= -->
<div class="card shadow-sm">
<div class="card-body p-0">

<table class="table table-striped table-hover align-middle mb-0">
<thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Category</th>
    <th>Budget</th>
    <th>Closing Date</th>
    <th>Status</th>
    <th class="text-nowrap" style="width:320px;">Action</th>
</tr>
</thead>

<tbody>

<?php foreach ($tenders as $t): ?>
<tr>
    <td><?= $t->tender_id ?></td>

    <td><?= h($t->title) ?></td>

    <td><?= h($t->category->category_name ?? '-') ?></td>

    <td>RM <?= number_format($t->budget,2) ?></td>

    <td><?= h($t->closing_date) ?></td>

    <td>
        <?= $t->status == 1
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-secondary">Archived</span>'
        ?>
    </td>

    <!-- ✅ ACTION BUTTONS FIXED -->
    <td>
        <div class="d-flex flex-wrap gap-2">

            <?= $this->Html->link(
                'View',
                ['action'=>'view',$t->tender_id],
                ['class'=>'btn btn-sm btn-outline-primary']
            ) ?>

            <?php if ($t->status == 1): ?>

                <?= $this->Html->link(
                    'Requirements',
                    [
                        'controller'=>'TenderRequirements',
                        'action'=>'index',
                        $t->tender_id
                    ],
                    ['class'=>'btn btn-sm btn-outline-secondary']
                ) ?>

                <?= $this->Html->link(
                    'Edit',
                    ['action'=>'edit',$t->tender_id],
                    ['class'=>'btn btn-sm btn-outline-success']
                ) ?>

                <?= $this->Form->postLink(
                    'Archive',
                    ['action'=>'archive',$t->tender_id],
                    [
                        'confirm'=>'Archive this tender?',
                        'class'=>'btn btn-sm btn-outline-danger'
                    ]
                ) ?>

            <?php endif; ?>

        </div>
    </td>

</tr>
<?php endforeach; ?>


<?php if ($tenders->isEmpty()): ?>
<tr>
    <td colspan="7" class="text-center py-4">
        No tenders found.
    </td>
</tr>
<?php endif; ?>

</tbody>
</table>

</div>
</div>
