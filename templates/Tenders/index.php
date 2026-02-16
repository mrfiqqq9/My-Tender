<?php
/**
 * @var \Cake\Collection\CollectionInterface $tenders
 * @var array $currentUser
 */
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0 fw-bold">Tenders</h2>

    <?php if (in_array($currentUser['role'], [1,2])): ?>
        <div>
            <?= $this->Html->link(
                '➕ Add Tender',
                ['action'=>'add'],
                ['class'=>'btn btn-primary me-2']
            ) ?>

            <?= $this->Html->link(
                '📋 View All',
                ['action'=>'all'],
                ['class'=>'btn btn-outline-secondary']
            ) ?>
        </div>
    <?php endif; ?>
</div>


<?php if (in_array($currentUser['role'], [1,2])): ?>
<div class="card shadow-sm mb-4 border-0">
    <div class="card-body">

        <?= $this->Form->create(null, [
            'type'=>'get',
            'class'=>'row g-3 align-items-center'
        ]) ?>

        <div class="col-md-4">
            <?= $this->Form->control('q', [
                'label'=>false,
                'placeholder'=>'Search tender...',
                'class'=>'form-control'
            ]) ?>
        </div>

        <div class="col-md-2">
            <?= $this->Form->button('Search', [
                'class'=>'btn btn-primary w-100'
            ]) ?>
        </div>

        <?= $this->Form->end() ?>

    </div>
</div>
<?php endif; ?>


<div class="card shadow-sm border-0">
<div class="card-body p-0">

<table class="table table-hover align-middle mb-0">
<thead class="table-dark">
<tr>
    <th width="60">ID</th>
    <th>Title</th>
    <th>Category</th>
    <th width="150">Budget</th>
    <th width="150">Closing Date</th>
    <th width="120">Status</th>
    <th width="220">Action</th>
</tr>
</thead>

<tbody>

<?php if ($tenders->isEmpty()): ?>
<tr>
    <td colspan="7" class="text-center py-4">
        <em>No tenders found.</em>
    </td>
</tr>
<?php endif; ?>


<?php foreach ($tenders as $t): ?>
<tr>
    <td><?= $t->tender_id ?></td>

    <td class="fw-semibold">
        <?= h($t->title) ?>
    </td>

    <td><?= h($t->category->category_name ?? '-') ?></td>

    <td>
        RM <?= number_format($t->budget,2) ?>
    </td>

    <td>
        <?= h($t->closing_date) ?>
    </td>

    <td>
        <?= $t->status == 1
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-secondary">Archived</span>'
        ?>
    </td>

    <td class="text-nowrap">

        <!-- VIEW -->
        <?= $this->Html->link(
            'View',
            ['action'=>'view',$t->tender_id],
            ['class'=>'btn btn-sm btn-outline-primary me-2']
        ) ?>

        <?php if ($currentUser['role'] !== 3): ?>

            <!-- MANAGE DROPDOWN -->
            <div class="btn-group">
                <button type="button"
                        class="btn btn-sm btn-outline-secondary dropdown-toggle"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                    Manage
                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow-sm">

                    <li>
                        <?= $this->Html->link(
                            'Requirements',
                            [
                                'controller'=>'TenderRequirements',
                                'action'=>'index',
                                $t->tender_id
                            ],
                            ['class'=>'dropdown-item']
                        ) ?>
                    </li>

                    <li>
                        <?= $this->Html->link(
                            'Edit',
                            ['action'=>'edit',$t->tender_id],
                            ['class'=>'dropdown-item']
                        ) ?>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <?= $this->Form->postLink(
                            'Archive',
                            ['action'=>'archive',$t->tender_id],
                            [
                                'confirm'=>'Archive this tender?',
                                'class'=>'dropdown-item text-danger'
                            ]
                        ) ?>
                    </li>

                </ul>
            </div>

        <?php endif; ?>

    </td>
</tr>
<?php endforeach; ?>

</tbody>
</table>

</div>
</div>
