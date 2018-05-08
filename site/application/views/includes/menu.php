<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li
            <?php
                if(isset($dashboard)){
                    echo " class='active'";
                }
            ?>
        >
            <a href="/site/index.php/admin/"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li
            <?php
            if(isset($manage_marathons)){
                echo " class='active'";
            }
            ?>
        >
            <a href="/site/index.php/admin/manage_marathons"><i class="fa fa-fw fa-wrench"></i> Manage Marathon</a>
        </li>
        <li
            <?php
            if(isset($add_marathon)){
                echo " class='active'";
            }
            ?>
        >
            <a href="/site/index.php/admin/add_marathon"><i class="fa fa-fw fa-edit"></i> Add Marathon</a>
        </li>
        <li
            <?php
            if(isset($manage_runners)){
                echo " class='active'";
            }
            ?>
        >
            <a href="/site/index.php/admin/manage_runners"><i class="fa fa-fw fa-wrench"></i> Manage Runners</a>
        </li>
        <li
            <?php
            if(isset($registration_form)){
                echo " class='active'";
            }
            ?>
        >
            <a href="/site/index.php/admin/registration_form"><i class="fa fa-fw fa-file"></i> Registration Form</a>
        </li>
    </ul>
</div>
<!-- /.navbar-collapse -->