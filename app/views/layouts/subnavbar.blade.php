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
        </ul>

    </div> <!-- /container -->

</div> <!-- /subnavbar-inner -->