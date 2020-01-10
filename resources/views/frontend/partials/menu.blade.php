@foreach($categories as $submenu)
    <li><a href="{{route('category.index',['id'=>$submenu])}}">{{ $submenu->name }}</a>
        @if(count($submenu->childrenRecursive)>0)
            <div class="dropdown-menu">
                <ul>
                    <li>@include('frontend.partials.menu',['categories'=>$submenu->childrenRecursive, 'level'=>$level+1])</li>
                </ul>
            </div>
        @endif
    </li>
@endforeach
