<div class="card shadow-sm">
    <div class="card-body">

        <h4 class="mb-4">Application Detail</h4>

        <table class="table table-bordered">

            <tr>
                <th width="30%">Application ID</th>
                <td><?= h($application->application_id) ?></td>
            </tr>

            <tr>
                <th>Tender</th>
                <td><?= h($application->tender->title ?? '-') ?></td>
            </tr>

            <tr>
                <th>Vendor</th>
                <td><?= h($application->vendor->company_name ?? '-') ?></td>
            </tr>

            <tr>
                <th>Proposed Price</th>
                <td>
                    RM <?= number_format((float)($application->proposed_price ?? 0), 2) ?>
                </td>
            </tr>

            <tr>
                <th>Proposal Description</th>
                <td><?= nl2br(h($application->proposal_description ?? '-')) ?></td>
            </tr>

            <tr>
                <th>Quotation File</th>
                <td>
                    <?php if (!empty($application->quotation_file)): ?>
                        <a href="<?= $this->Url->build('/uploads/quotations/' . $application->quotation_file) ?>"
                           class="btn btn-sm btn-outline-primary"
                           target="_blank">
                            <i class="bi bi-file-earmark-text me-1"></i> View Quotation
                        </a>
                    <?php else: ?>
                        <span class="text-muted">No file uploaded</span>
                    <?php endif; ?>
                </td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    <?php
                    $statusBadge = match ((int)$application->status) {
                        0 => '<span class="badge bg-warning text-dark">Pending</span>',
                        1 => '<span class="badge bg-success">Approved</span>',
                        2 => '<span class="badge bg-danger">Rejected</span>',
                        default => '-'
                    };
                    echo $statusBadge;
                    ?>
                </td>
            </tr>

            <tr>
                <th>Applied At</th>
                <td>
                    <?= $application->applied_at
                        ? $application->applied_at->format('d/m/Y H:i')
                        : '-' ?>
                </td>
            </tr>

        </table>

        <!-- APPROVE / REJECT -->
        <?php if (in_array($currentUser['role'], [1,2]) && (int)$application->status === 0): ?>

            <hr class="my-4">

            <h5 class="mb-3">Decision Panel</h5>

            <?= $this->Form->create(null, [
                'url' => ['action' => 'updateStatus', $application->application_id]
            ]) ?>

            <div class="row g-3">

                <?php if ($currentUser['role'] == 1): ?>
                <div class="col-12">
                    <?= $this->Form->control('remarks', [
                        'type' => 'textarea',
                        'label' => 'Admin Remarks (Optional)',
                        'rows' => 3
                    ]) ?>
                </div>
                <?php endif; ?>

                <div class="col-12 d-flex gap-3">
                    <?= $this->Form->button(
                        '<i class="bi bi-check-circle me-1"></i> Approve',
                        [
                            'name' => 'status',
                            'value' => 1,
                            'class' => 'btn btn-success px-4',
                            'escapeTitle' => false
                        ]
                    ) ?>

                    <?= $this->Form->button(
                        '<i class="bi bi-x-circle me-1"></i> Reject',
                        [
                            'name' => 'status',
                            'value' => 2,
                            'class' => 'btn btn-danger px-4',
                            'escapeTitle' => false
                        ]
                    ) ?>
                </div>

            </div>

            <?= $this->Form->end() ?>

        <?php endif; ?>

        <?= $this->Html->link(
            '← Back',
            in_array($currentUser['role'], [1,2])
                ? ['action' => 'index']
                : ['action' => 'myApplications'],
            ['class' => 'btn btn-secondary mt-4']
        ) ?>

    </div>
</div>


<?php if (in_array($currentUser['role'], [1,2])): ?>

<hr class="my-4">

<h5>Vendor Application History</h5>

<?php if (!empty($vendorHistory)): ?>

<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>Tender</th>
            <th>Tender Budget (RM)</th>
            <th>Proposed Price (RM)</th>
            <th>Difference</th>
            <th>Status</th>
            <th>Applied At</th>
        </tr>
    </thead>
    <tbody>

    <?php foreach ($vendorHistory as $h): ?>

        <?php
        $budget = (float)($h->tender->budget ?? 0);
        $price  = (float)($h->proposed_price ?? 0);
        $diff   = $budget - $price;
        ?>

        <tr>
            <td><?= h($h->tender->title ?? '-') ?></td>
            <td>RM <?= number_format($budget,2) ?></td>
            <td>RM <?= number_format($price,2) ?></td>
            <td>RM <?= number_format($diff,2) ?></td>
            <td>
                <?php
                echo match ((int)$h->status) {
                    0 => '<span class="badge bg-warning text-dark">Pending</span>',
                    1 => '<span class="badge bg-success">Approved</span>',
                    2 => '<span class="badge bg-danger">Rejected</span>',
                    default => '-'
                };
                ?>
            </td>
            <td>
                <?= $h->applied_at
                    ? $h->applied_at->format('d/m/Y H:i')
                    : '-' ?>
            </td>
        </tr>

    <?php endforeach; ?>

    </tbody>
</table>

<?php else: ?>

<div class="alert alert-light">
    No application history found.
</div>

<?php endif; ?>

<?php endif; ?>
