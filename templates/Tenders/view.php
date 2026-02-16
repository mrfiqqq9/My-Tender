<div class="card shadow-sm">
<div class="card-body">

<h3 class="mb-3"><?= h($tender->title) ?></h3>

<p>
<strong>Status:</strong>
<?= $tender->status==1
    ? '<span class="badge bg-success">Active</span>'
    : '<span class="badge bg-secondary">Archived</span>'
?>
</p>

<p><strong>Category:</strong> <?= h($tender->category->category_name) ?></p>
<p><strong>Budget:</strong> RM <?= number_format($tender->budget,2) ?></p>
<p><strong>Closing Date:</strong> <?= h($tender->closing_date) ?></p>

<hr>

<h5>Description</h5>
<p><?= nl2br(h($tender->description)) ?></p>

<hr>

<h5>Requirements</h5>

<?php if (!empty($tender->tender_requirements)): ?>
<table class="table table-bordered">
<tr>
<th>Requirement</th>
<th>Value</th>
<th>Description</th>
</tr>

<?php foreach ($tender->tender_requirements as $r): ?>
<tr>
<td><?= h($r->requirement_label) ?></td>
<td>
<?php
if ($r->requirement_value === null) {
    echo '-';
} elseif (in_array($r->requirement_type,\App\Model\Entity\TenderRequirement::MONEY_TYPES)) {
    echo 'RM '.number_format($r->requirement_value,2);
} else {
    echo (int)$r->requirement_value;
}
?>
</td>
<td><?= h($r->description ?? '-') ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<p>No requirements specified.</p>
<?php endif; ?>

<hr>

<?php if ($currentUser['role'] === 3): ?>
    <?= $this->Html->link(
        'Apply Tender',
        ['controller'=>'TenderApplications','action'=>'add',$tender->tender_id],
        ['class'=>'btn btn-primary']
    ) ?>
<?php endif; ?>

<?= $this->Html->link(
    '← Back',
    ['action'=>'index'],
    ['class'=>'btn btn-outline-secondary ms-2']
) ?>

</div>
</div>
