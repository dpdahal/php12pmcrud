<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=base_url('public/images/users/'.$_SESSION['user_image'])?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?=$_SESSION['user_name']?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">PHP12PM</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="<?=admin_url('dashboard')?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

           <li><a href="<?=admin_url('manage_user_privilege')?>"> <i class="fa fa-lock"></i> Mange Privileges</a></li>

            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i> <span>Users</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=admin_url('add-user')?>">Add User</a></li>
                    <li><a href="<?=admin_url('show_users')?>">Show Users</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-image"></i> <span>Slide Show</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=admin_url('add_slider')?>">Add Slider </a></li>
                    <li><a href="<?=admin_url('show_slider')?>">Show Slider</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>