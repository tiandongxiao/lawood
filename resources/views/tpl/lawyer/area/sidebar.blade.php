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
            <li><a href="#"><i class="fa fa-calendar"></i> <span>管理面板</span></a></li>
            <li><a href="{{url('lawyer/notifies')}}">
                    <i class="fa fa-calendar"></i> <span>消息通知</span>
                    <small class="label pull-right bg-red">3</small>
                </a>
            </li>
            <li><a href="{{url('lawyer/orders')}}"><i class="fa fa-calendar"></i> <span>我的订单</span></a></li>
            <li class="nav-divider"></li>
            <li><a href="{{url('lawyer/show/'.Auth::user()->id)}}"><i class="fa fa-calendar"></i> <span>我的主页</span></a></li>
            <li><a href="{{url('lawyer/wallet')}}"><i class="fa fa-calendar"></i> <span>我的钱包</span></a></li>
            <li><a href="#"><i class="fa fa-calendar"></i> <span>停用</span></a></li>
            <li><a href="#"><i class="fa fa-calendar"></i> <span>设置</span></a></li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>