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
                <a href="{{ URL::to('docto') }}">
                    <i class="icon-briefcase "></i>
                    <span>{{ trans("gen.documents inbox") }}</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::to('docfrom') }}">
                    <i class="icon-envelope "></i>
                    <span>{{ trans("gen.documents sent") }}</span>
                </a>
            </li>
        </ul>
    </div> <!-- /container -->
</div> <!-- /subnavbar-inner -->