<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Tender Requirements</h2>

    <div>
        <?= $this->Html->link(
            '+ Add Requirement',
            ['action' => 'add', $tenderId],
            ['class' => 'btn btn-primary me-2']
        ) ?>

        <?= $this->Html->link(
            '← Back to Tender',
            ['controller'=>'Tenders','action'=>'view',$tenderId],
            ['class'=>'btn btn-outline-secondary']
        ) ?>
    </div>
</div>

<div class="card shadow-sm">
<div class="card-body p-0">

<table class="table table-striped table-hover align-middle mb-0">
    <thead class="table-dark">
        <tr>
            <th>Requirement</th>
            <th>Value</th>
            <th>Description</th>
            <th width="160">Action</th>
        </tr>
    </thead>

    <tbody>

<?php foreach ($requirements as $r): ?>
<tr>
    <td><?= h($r->requirement_label) ?></td>

    <td>
        <?php
        if ($r->requirement_value === null) {
            echo '-';
        } elseif (
            in_array(
                $r->requirement_type,
                \App\Model\Entity\TenderRequirement::MONEY_TYPES
            )
        ) {
            echo 'RM ' . number_format($r->requirement_value, 2);
        } else {
            echo (int)$r->requirement_value;
        }
        ?>
    </td>

    <td><?= h($r->description ?? '-') ?></td>

    <td>
        <?= $this->Html->link(
            'Edit',
            ['action'=>'edit',$r->requirement_id],
            ['class'=>'btn btn-sm btn-outline-success']
        ) ?>

        <?= $this->Form->postLink(
            'Delete',
            ['action'=>'delete',$r->requirement_id],
            [
                'confirm'=>'Delete this requirement?',
                'class'=>'btn btn-sm btn-outline-danger'
            ]
        ) ?>
    </td>
</tr>
<?php endforeach; ?>

<?php if (empty($requirements)): ?>
<tr>
    <td colspan="4" class="text-center p-4">
        No requirements found.
    </td>
</tr>
<?php endif; ?>

    </tbody>
</table>

</div>
</div>
