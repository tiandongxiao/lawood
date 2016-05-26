<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{URL::asset('/')}}images/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>sanmingzhi</p>
                <!-- Status -->
                <a href="#"><i class="icon-camera-retro"></i> 在线</a>
            </div>
        </div>
        <hr/>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li>
                <a href="{{url('site/lawyers/unapproved')}}">
                    <i class="fa fa-user"></i> <span>律师审核</span>
                </a>
            </li>
            <li>
                <a href="{{url('site/user')}}">
                    <i class="fa fa-user"></i> <span>用户管理</span>
                </a>
            </li>
            <li>
                <a href="{{url('site/role')}}">
                    <i class="fa fa-unlock-alt"></i> <span>角色管理</span>
                </a>
            </li>
            <li>
                <a href="{{url('site/permission')}}">
                    <i class="fa fa-key"></i> <span>权限管理</span>
                </a>
            </li>
            <li>
                <a href="{{url('site/calendar')}}">
                    <i class="fa fa-calendar-check-o"></i> <span>任务日历</span>
                    <small class="label pull-right bg-red">3</small>
                </a>
            </li>
            <li>
                <a href="{{url('site/logs')}}">
                    <i class="fa  fa-pencil"></i> <span>日志分析</span>
                </a>
            </li>
            <li>
                <a href="{{url('site/settings')}}">
                    <i class="fa fa-cog"></i> <span>设置</span>
                </a>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>