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
                <a class="vt-documents-to" href="{{ URL::to('docto') }}">
                    <i class="icon-briefcase ">
                        @if(!empty($number))
                        <span class="vt_number_docs" > {{$number}} </span>
                        @endif
                    </i>

                    <span>{{ trans("gen.documents inbox") }}
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ URL::to('docfrom') }}">
                    <i class="icon-envelope "></i>
                    <span>{{ trans("gen.documents sent") }}</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::route('memberdocuments.create') }}">
                    <i class="icon-pencil"></i>
                    <span>{{ trans("gen.new document") }}</span>
                </a>
            </li>
        </ul>
    </div> <!-- /container -->
</div> <!-- /subnavbar-inner -->