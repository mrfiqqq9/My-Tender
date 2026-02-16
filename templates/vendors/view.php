<div class="card shadow-sm">
<div class="card-body">

<h3 class="mb-4">Vendor Detail</h3>

<table class="table table-bordered">
<tr><th>Company</th><td><?= h($vendor->company_name) ?></td></tr>
<tr><th>Email</th><td><?= h($vendor->user->email ?? '-') ?></td></tr>
<tr><th>Experience</th><td><?= h($vendor->years_experience) ?> years</td></tr>
<tr>
<th>Status</th>
<td>
<?= match ($vendor->vendor_status) {
    0 => '<span class="badge bg-warning text-dark">Pending</span>',
    1 => '<span class="badge bg-success">Approved</span>',
    2 => '<span class="badge bg-danger">Rejected</span>',
    3 => '<span class="badge bg-secondary">Suspended</span>'
} ?>
</td>
</tr>
<tr>
<th>Paid Up Capital</th>
<td>RM <?= number_format($vendor->paid_up_capital,2) ?></td>
</tr>
<tr>
    <th>SSM Certificate</th>
    <td>
        <?php if (!empty($vendor->ssm_file)): ?>
            <a href="<?= $this->Url->build('/webroot/uploads/ssm/' . $vendor->ssm_file) ?>"
   class="btn btn-sm btn-outline-primary"
   target="_blank">
   <i class="bi bi-file-earmark-pdf me-1"></i> View SSM
</a>
        <?php else: ?>
            <span class="text-muted">No file uploaded</span>
        <?php endif; ?>
    </td>
</tr>

<tr>
    <th>TCC Certificate</th>
    <td>
        <?php if (!empty($vendor->tcc_file)): ?>
            <a href="<?= $this->Url->build('/webroot/uploads/tcc/' . $vendor->tcc_file) ?>"
   class="btn btn-sm btn-outline-primary"
   target="_blank">
   <i class="bi bi-file-earmark-pdf me-1"></i> View TCC
</a>
        <?php else: ?>
            <span class="text-muted">No file uploaded</span>
        <?php endif; ?>
    </td>
</tr>
</table>

<?php if ($currentUser['role'] === 1): ?>

<hr>

<h5>Admin Decision</h5>

<?= $this->Form->create(null, [
    'url'=>['action'=>'updateStatus',$vendor->vendor_id]
]) ?>

<div class="mb-3">
<?= $this->Form->control('vendor_status', [
    'type'=>'select',
    'options'=>[
        1=>'Approve',
        2=>'Reject',
        3=>'Suspend'
    ],
    'class'=>'form-select'
]) ?>
</div>

<?= $this->Form->button('Update Status', [
    'class'=>'btn btn-success'
]) ?>

<?= $this->Form->end() ?>

<?php endif; ?>

</div>
</div>
