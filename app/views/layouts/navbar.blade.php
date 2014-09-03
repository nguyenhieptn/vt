<div class="navbar-inner">

    <div class="container">

        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <a class="brand" href="index.html">
            {{ trans("gen.THAI NGUYEN POST") }}
        </a>

        <div class="nav-collapse">
            <ul class="nav pull-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-user"></i>
                        {{ Sentry::getUser()->username }}
                        <b class="caret"></b>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="">Profile</a></li>
                        <li><a href="logout">Logout</a></li>
                    </ul>
                </li>
            </ul>

            <form class="navbar-search pull-right">
                <input type="text" class="search-query" placeholder="Search">
            </form>

        </div><!--/.nav-collapse -->

    </div> <!-- /container -->

</div> <!-- /navbar-inner -->