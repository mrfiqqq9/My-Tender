<ul class="nav flex-column">

<li class="nav-item">
<?= $this->Html->link(
    '<i class="bi bi-speedometer2 me-2"></i> Dashboard',
    ['controller'=>'Dashboard','action'=>'vendor'],
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
    '<i class="bi bi-person-badge me-2"></i> Vendor Info',
    ['controller'=>'Vendors','action'=>'profile'],
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
    '<i class="bi bi-file-earmark-text me-2"></i> My Applications',
    ['controller'=>'TenderApplications','action'=>'myApplications'],
    ['class'=>'nav-link','escape'=>false]
) ?>
</li>

<li class="nav-item">
<?= $this->Html->link(
    '<i class="bi bi-graph-up-arrow me-2"></i> Analytics',
    ['controller'=>'Analytics','action'=>'vendor'],
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
