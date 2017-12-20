<?php
function current_page($url = '/'){
  return request()->path() == $url;
}
?>
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
        @if (Auth::user()->avatar == null)
          <img src="{{ asset('dist/img/user.jpg')}}" class="img-circle" alt="User Image">
        @else
          <img src="{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
        @endif
        </div>
        <div class="pull-left info">
          <p>
          @if (Auth::user()->social_name == null)
            {{ Auth::user()->name}}
          @else
            {{ Auth::user()->social_name}}
          @endif
          </p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->

      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li <?php echo current_page('home') ? "class='active'" : "";?>><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> <span>Home</span></a></li>

        <li
          <?php
          if (current_page('clientes')) {
            echo "class='treeview active'";
          }
          if (current_page('sedes')) {
            echo "class='treeview active'";
          }
          if (current_page('asignacion')) {
            echo "class='treeview active'";
          }
          if (current_page('ajustes')) {
            echo "class='treeview active'";
          }
          if (current_page('actividades-client')) {
            echo "class='treeview active'";
          }
          if (current_page('personas')) {
            echo "class='treeview active'";
          }
          else {
            echo "class='treeview'";
          }

          ?>

        >
          <a href="#"><i class="fa fa-heartbeat"></i> <span>Actividades</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">

            @if(Auth::user()->rol_id <= 2 OR Auth::user()->rol_id == 7)
            <li <?php echo current_page('asignacion') ? "class='active'" : "";?>><a href="{{ url('asignacion')}}">Asignacion</a></li>
            @endif
            @if(Auth::user()->rol_id <= 2)
            <li <?php echo current_page('actividades-client') ? "class='active'" : "";?>><a href="{{ url('actividades-client')}}">Actividad Cliente</a></li>
            @endif
            @if(Auth::user()->rol_id <= 2 OR Auth::user()->rol_id == 10)
            <li <?php echo current_page('sedes') ? "class='active'" : "";?>><a href="{{ url('sedes')}}">Sedes</a></li>
            @endif
            @if(Auth::user()->rol_id <= 2 OR Auth::user()->rol_id == 10)
              <li <?php echo current_page('clientes') ? "class='active'" : "";?>><a href="{{ url('clientes')}}">Clientes</a></li>
            @endif
            @if(Auth::user()->rol_id <= 2)
              <li <?php echo current_page('personas') ? "class='active'" : "";?>><a href="{{ url('personas')}}">Personas</a></li>
            @endif
            @if(Auth::user()->rol_id <= 2)
              <li <?php echo current_page('ajustes') ? "class='active'" : "";?>><a href="{{ url('ajustes')}}">Ajustes</a></li>
            @endif

          </ul>

        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
