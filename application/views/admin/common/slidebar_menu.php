<!--sidebar-menu-->
<div id="sidebar"><a href="<?php echo base_url('admin'); ?>" class="visible-phone"><i class="icon icon-reorder"></i> Menu</a>
  <ul>
    <li><a href="<?php echo base_url('admin'); ?>"><i class="icon icon-dashboard"></i> <span>Dashboard</span></a> </li>

    <li class="submenu"> <a href="<?php echo base_url('admin/catalog'); ?>"><i class="icon icon-pencil"></i> <span>Catalog</span></a> 
      <ul>
        <li><a href="<?php echo base_url('admin/catalog/categories'); ?>">Categories</a></li>
        <li><a href="<?php echo base_url('admin/catalog/products'); ?>">Products</a></li>
        <li><a href="<?php echo base_url('admin/catalog/manufacturers'); ?>">Manufacturers</a></li>
        <li><a href="<?php echo base_url('admin/catalog/reviews'); ?>">Reviews</a></li>
        <li><a href="<?php echo base_url('admin/catalog/informations'); ?>">Informations</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="<?php echo base_url('admin/sales'); ?>"><i class="icon icon-shopping-cart"></i> <span>Sales</span></a> 
      <ul>
        <li><a href="<?php echo base_url('admin/sales/orders'); ?>">Orders</a></li>
        <li><a href="<?php echo base_url('admin/sales/payments'); ?>">Payments</a></li>
        <li><a href="<?php echo base_url('admin/sales/customers'); ?>">Customers</a></li>
      </ul>
    </li>

    <li class="submenu"> <a href="<?php echo base_url('admin/system'); ?>"><i class="icon icon-cog"></i> <span>System</span></a> 
      <ul>
        <li><a href="<?php echo base_url('admin/system/settings'); ?>">Settings</a></li>
        <li><a href="<?php echo base_url('admin/system/users'); ?>">Users</a></li>
        <li><a href="<?php echo base_url('admin/system/user_groups'); ?>">User Groups</a></li>
      </ul>
    </li>       
  </ul>
</div>
<!--sidebar-menu-->