<nav id="sidebar">
  <!-- Sidebar Content -->
  <div class="sidebar-content">
    <!-- Side Header -->
    <div class="content-header justify-content-lg-center bg-black-10">
      <!-- Logo -->
      <div>
        <span class="smini-visible fw-bold tracking-wide fs-lg">
          c<span class="text-primary">b</span>
        </span>
        <a class="link-fx fw-bold tracking-wide mx-auto" href="{{ route('donors.home') }}">
          <span class="smini-hidden">
            <span class="fs-4 text-dual">PMI</span> <span class="fs-4 text-danger">SUKABUMI</span>
          </span>
        </a>
      </div>
      <!-- END Logo -->

      <!-- Options -->
      <div>
        <!-- Close Sidebar, Visible only on mobile screens -->
        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
        <button type="button" class="btn btn-sm btn-alt-danger d-lg-none" data-toggle="layout" data-action="sidebar_close">
          <i class="fa fa-fw fa-times"></i>
        </button>
        <!-- END Close Sidebar -->
      </div>
      <!-- END Options -->
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
      <!-- Side Main Navigation -->
      <div class="content-side content-side-full">
        <ul class="nav-main">
          @include('bases.components.navigation')
        </ul>
      </div>
      <!-- END Side Main Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
  </div>
  <!-- Sidebar Content -->
</nav>