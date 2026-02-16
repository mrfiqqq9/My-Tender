<ul class="nav flex-column">

<li class="nav-item">
<?= $this->Html->link(
    '<i class="bi bi-speedometer2 me-2"></i> Dashboard',
    ['controller'=>'Dashboard','action'=>'index'],
    ['class'=>'nav-link','escape'=>false]
) ?>
</li>
<li class="nav-item">
<?= $this->Html->link(
    '<i class="bi bi-person-circle me-2"></i> My Profile',
    ['controller'=>'Profiles','action'=>'index'],
    ['class'=>'nav-link','escape'=>false]
) ?>
</li>

<li class="nav-item">
<?= $this->Html->link(
    '<i class="bi bi-folder2-open me-2"></i> Tenders',
    ['controller'=>'Tenders','action'=>'index'],
    ['class'=>'nav-link','escape'=>false]
) ?>
</li>

<li class="nav-item">
<?= $this->Html->link(
    '<i class="bi bi-file-earmark-text me-2"></i> Applications',
    ['controller'=>'TenderApplications','action'=>'index'],
    ['class'=>'nav-link','escape'=>false]
) ?>
</li>

<li class="nav-item">
<?= $this->Html->link(
    '<i class="bi bi-building me-2"></i> Vendors',
    ['controller'=>'Vendors','action'=>'index'],
    ['class'=>'nav-link','escape'=>false]
) ?>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button"
       data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-gear-wide-connected me-2"></i>Administration
    </a>

    <ul class="dropdown-menu">

        <li>
            <?= $this->Html->link(
                '<i class="bi bi-person-lines-fill"></i> Staff Management',
                ['controller'=>'Administration','action'=>'staff'],
                ['class'=>'dropdown-item','escape'=>false]
            ) ?>
        </li>
        <li>
                <?= $this->Html->link(
                    '<i class="bi bi-people me-2"></i> Users',
                    ['controller'=>'Users','action'=>'index'],
                    ['class'=>'dropdown-item','escape'=>false]
                ) ?>
        </li>
        <li>
                <?= $this->Html->link(
                    '<i class="bi bi-newspaper me-2"></i> News Management',
                    ['controller'=>'News','action'=>'index'],
                    ['class'=>'dropdown-item','escape'=>false]
                ) ?>
</li>
    </ul>
</li>

<li class="nav-item">
<?= $this->Html->link(
    '<i class="bi bi-clock-history me-2"></i> Audit Logs',
    ['controller'=>'TenderApplications','action'=>'audit'],
    ['class'=>'nav-link','escape'=>false]
) ?>
</li>

<li class="nav-item">
<?= $this->Html->link(
    '<i class="bi bi-tags me-2"></i> Categories',
    ['controller' => 'Categories', 'action' => 'index'],
    ['class' => 'nav-link','escape' => false ]
) ?>
</li>

<li class="nav-item">
<?= $this->Html->link(
    '<i class="bi bi-graph-up-arrow me-2"></i> Analytics',
    ['controller'=>'Analytics','action'=>'admin'],
    ['class'=>'nav-link','escape'=>false]
) ?>
</li>

<li class="nav-item">
<?= $this->Html->link(
    '<i class="bi bi-bell me-2"></i> Notifications',
    ['controller'=>'Notifications','action'=>'index'],
    ['class'=>'nav-link','escape'=>false]
) ?>
</li>

<hr class="text-secondary">

<li class="nav-item">
<?= $this->Html->link(
    '<i class="bi bi-box-arrow-right me-2"></i> Logout',
    ['controller'=>'Auth','action'=>'logout'],
    ['class'=>'nav-link text-danger','escape'=>false]
) ?>
</li>

</ul>
