<div class="subnavbar-inner">

    <div class="container">

        <ul class="mainnav">
            <li>
                <a href="{{ URL::to('dashboard') }}">
                    <i class="icon-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::to('documents') }}">
                    <i class="icon-envelope "></i>
                    <span>{{ trans("gen.documents") }}</span>
                </a>
            </li>

            <li>
                <a href="{{ URL::route('units.index') }}">
                    <i class="icon-table "></i>
                    <span>{{ trans("gen.unit") }}</span>
                </a>
            </li>

            <li>
                <a href="{{ URL::to('users') }}">
                    <i class="icon-group"></i>
                    <span>{{ trans("gen.users") }}</span>
                </a>
            </li>



            <li>
                <a href="charts.html">
                    <i class="icon-bar-chart"></i>
                    <span>Charts</span>
                </a>
            </li>


            <li>
                <a href="shortcodes.html">
                    <i class="icon-code"></i>
                    <span>Shortcodes</span>
                </a>
            </li>

            <li class="active dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-long-arrow-down"></i>
                    <span>Drops</span>
                    <b class="caret"></b>
                </a>

                <ul class="dropdown-menu">
                    <li><a href="icons.html">Icons</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                    <li><a href="pricing.html">Pricing Plans</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="signup.html">Signup</a></li>
                    <li><a href="error.html">404</a></li>
                </ul>
            </li>

        </ul>

    </div> <!-- /container -->

</div> <!-- /subnavbar-inner -->