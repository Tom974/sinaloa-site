<!-- Side Overlay-->
<aside id="side-overlay">
    <!-- Side Header -->
    <div class="bg-primary">
        <div class="content-header">
            <!-- User Avatar -->
            <a class="img-link mr-1" href="https://i.imgur.com/2SQCSBl.png" target="_blank">
                <img class="img-avatar img-avatar32 img-avatar-thumb" src="https://i.imgur.com/2SQCSBl.png" alt="">
            </a>
            <!-- END User Avatar -->
            <!-- User Info -->
            <div class="ml-2">
                <a class="text-white font-w600 welkom-naam" href="javascript:void(0)"><?= $login['naam'] ?></a>
            </div>
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="ml-auto text-white" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
                <i class="fa fa-times"></i>
            </a>
            <!-- END Close Side Overlay -->
        </div>
    </div>
    <!-- END Side Header -->
    <?php
    $x = pathinfo("https://tom974.dev/". $_SERVER["SCRIPT_NAME"]);
    $dir = explode("/", $x['dirname']);
    # PHP Code to determine on what page we are currently on.
    ?>
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link" href="<?= str_replace("/home/tom/domains/tom974.dev/public_html", "", $_SERVER['DOCUMENT_ROOT']) ?>/sinaloa">
                    <i class="nav-main-link-icon fa fas fa-laptop"></i>
                    <span class="nav-main-link-name">Dashboard</span>
                </a>
            </li>
            <li class="nav-main-heading">Manage</li>
            <li class="nav-main-item">
                <a class="nav-main-link <?php if ($dir[5] == "wiet") echo "active"; ?> " href="<?= str_replace("/home/tom/domains/tom974.dev/public_html", "", $_SERVER['DOCUMENT_ROOT']) ?>/sinaloa/wiet">
                    <i class="nav-main-link-icon fa fas fa-cannabis"></i>
                    <span class="nav-main-link-name">Wiet</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link <?php if ($dir[5] == "meth") echo "active"; ?> " href="<?= str_replace("/home/tom/domains/tom974.dev/public_html", "", $_SERVER['DOCUMENT_ROOT']) ?>/sinaloa/meth">
                    <i class="nav-main-link-icon fa fas fa-cannabis"></i>
                    <span class="nav-main-link-name">Meth</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link <?php if ($dir[5] == "meth2") echo "active"; ?> " href="<?= str_replace("/home/tom/domains/tom974.dev/public_html", "", $_SERVER['DOCUMENT_ROOT']) ?>/sinaloa/meth2">
                    <i class="nav-main-link-icon fa fas fa-cannabis"></i>
                    <span class="nav-main-link-name">Meth2</span>
                </a>
            </li>
            <li class="nav-main-heading">Account</li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="javascript:goToAdminPage()">
                    <i class="nav-main-link-icon fa fa-user"></i>
                    <span class="nav-main-link-name">Admin</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
                    <i class="nav-main-link-icon fa fa-arrow-left"></i>
                    <span class="nav-main-link-name">Go Back</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- END Side Navigation -->
</aside>
<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div>
            <!-- Logo -->
            <a class="font-w600 text-dual tracking-wide" href="https://tom974.dev/sinaloa">
                Sinaloa <span class="opacity-75">Drugs</span>
            </a>
            <!-- END Logo -->
        </div>
        <div class="d-flex align-items-center">
            <!-- Open Search Section -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-sm btn-dual d-md-none" data-toggle="layout" data-action="header_search_on">
                <i class="fa fa-fw fa-search"></i>
            </button>
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-sm btn-dual" data-toggle="layout" data-action="side_overlay_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <!-- END Toggle Side Overlay -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header bg-white">
        <div class="content-header">
            <form class="w-100" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                    <div class="input-group-append">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-secondary" data-toggle="layout" data-action="header_search_off">
                            <i class="fa fa-fw fa-times-circle"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Header Search -->

    <!-- Header Loader -->
    <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-white">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-2x fa-sun fa-spin"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
<!-- END Header -->