<h2 class="mb-3">Global Audit Logs</h2>
<p class="text-muted">All tender decisions (Admin & Staff)</p>

<div class="card shadow-sm mb-4">
<div class="card-body">

<form method="get" class="row g-3">

<div class="col-md-3">
<select name="role" class="form-select">
    <option value="">-- All Roles --</option>
    <option value="1" <?= ($role==='1')?'selected':'' ?>>Admin</option>
    <option value="2" <?= ($role==='2')?'selected':'' ?>>Staff</option>
</select>
</div>

<div class="col-md-3">
<select name="action" class="form-select">
    <option value="">-- All Actions --</option>
    <option value="approved" <?= ($action==='approved')?'selected':'' ?>>Approved</option>
    <option value="rejected" <?= ($action==='rejected')?'selected':'' ?>>Rejected</option>
</select>
</div>

<div class="col-md-2">
<button class="btn btn-primary w-100">Filter</button>
</div>

<div class="col-md-2">
<a href="<?= $this->Url->build(['action'=>'audit']) ?>"
   class="btn btn-secondary w-100">Reset</a>
</div>

</form>

</div>
</div>

<div class="card shadow-sm">
<div class="card-body p-0">

<table class="table table-striped align-middle mb-0">
<thead class="table-dark">
<tr>
<th>#</th>
<th>Tender</th>
<th>Vendor</th>
<th>Action</th>
<th>Performed By</th>
<th>Role</th>
<th>Date</th>
</tr>
</thead>

<tbody>
<?php $i=1; foreach ($logs as $log): ?>
<tr>
<td><?= $i++ ?></td>
<td><?= h($log->tender->title ?? '-') ?></td>
<td><?= h($log->vendor->company_name ?? '-') ?></td>

<td>
<?= $log->action==='approved'
    ? '<span class="badge bg-success">Approved</span>'
    : '<span class="badge bg-danger">Rejected</span>'
?>
</td>

<td><?= h($log->user->name ?? 'System') ?></td>

<td><?= $log->performed_role==1?'Admin':'Staff' ?></td>

<td><?= $log->created_at->format('d/m/Y H:i') ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>
</div>
