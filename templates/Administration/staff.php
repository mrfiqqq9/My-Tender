<div class="container py-4">

    <h3 class="mb-4">
        <i class="bi bi-people me-2"></i>Staff Management
    </h3>

    <!-- SEARCH -->
    <form method="get" class="mb-3">
        <div class="input-group w-50">
            <input type="text" name="search" value="<?= h($search) ?>" 
                   class="form-control" placeholder="Search name or email">
            <button class="btn btn-dark">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Role</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($staffList as $staff): ?>
                    <tr>
                        <td><?= h($staff->name) ?></td>
                        <td><?= h($staff->email) ?></td>
                        <td><?= h($staff->staff->department ?? '-') ?></td>
                        <td><?= h($staff->staff->position ?? '-') ?></td>
                        <td>
                        <?php if ($staff->role == 1): ?>
                        <span class="badge bg-danger">Admin</span>
                        <?php else: ?>
                        <span class="badge bg-secondary">Staff</span>
                        <?php endif; ?>
                        </td>
                        <td>
                            <?= $this->Html->link(
                            'View',
                            ['action'=>'view',$staff->user_id],
                             ['class'=>'btn btn-sm btn-info text-white']
                            ) ?>

                            <?= $this->Html->link(
                                'Edit',
                                ['action'=>'edit',$staff->user_id],
                                ['class'=>'btn btn-sm btn-warning text-dark']
                            ) ?>


                            <?= $this->Form->postLink(
                                'Delete',
                                ['action'=>'delete',$staff->user_id],
                                [
                                    'class'=>'btn btn-sm btn-danger',
                                    'confirm'=>'Are you sure?'
                                ]
                            ) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>
</div>
