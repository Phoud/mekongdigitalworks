 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('/')}}/images/logo/{{Session::get('logoPath')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
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
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Homepage</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.logo')}}"><i class="fa fa-circle-o"></i>Logo</a></li>
            <li><a href="{{route('admin.banner')}}"><i class="fa fa-circle-o"></i>Banners</a></li>
            <li><a href="{{route('admin.homepage_service')}}"><i class="fa fa-circle-o"></i>Services</a></li>
            <li><a href="{{route('admin.aboutus')}}"><i class="fa fa-circle-o"></i>About Us</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i>Latest News</a></li>
            <li><a href="{{route('admin.partners')}}"><i class="fa fa-circle-o"></i>Our partners</a></li>
            <li><a href="{{route('admin.contactarea')}}"><i class="fa fa-circle-o"></i>Contact area</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Service</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.service')}}"><i class="fa fa-circle-o"></i>Service</a></li>
          </ul>
        </li>
       
       <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
           <span>Package</span>
           <ul class="treeview-menu">
             <li><a href="{{route('admin.package')}}"><i class="fa fa-circle-o"></i>package</a></li>
             <li><a href="{{route('admin.packagecat')}}"><i class="fa fa-circle-o"></i>package category</a></li>
           </ul>
          </a>
        </li>

           <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Portfolio</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.portfolio')}}"><i class="fa fa-circle-o"></i>Portfolio</a></li>
          </ul>
        </li>

         <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>About</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.information')}}"><i class="fa fa-circle-o">Infomation</i></a></li>
            <li><a href="{{route('admin.skill')}}"><i class="fa fa-circle-o">Skills</i></a></li>
            <li><a href="{{route('admin.team')}}"><i class="fa fa-circle-o">Team</i></a></li>
          </ul>
        </li>

         <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Template</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.template')}}"><i class="fa fa-circle-o"></i>Template</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Blog</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('blog.create')}}"><i class="fa fa-circle-o"></i>New Post</a></li>
            <li><a href="{{route('blog.index')}}"><i class="fa fa-circle-o"></i>Blog Index</a></li>
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>