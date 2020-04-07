@if ($item["submenu"] == [])
<li class="{{getMenuActivo($item['menu_url'])}}">
<a href="{{url($item['menu_url'])}}">
    <i class="fa {{$item["menu_icono"]}}"></i> <span>{{$item["menu_nombre"]}}</span>
  </a>
</li>
@else
    <li class="treeview">
        <a href="javascript:;">
          <i class="fa {{$item["menu_icono"]}}"></i> <span>{{$item["menu_nombre"]}}</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
            @foreach ($item["submenu"] as $submenu)
                @include("theme.$theme.menu-item", ["item" => $submenu])
            @endforeach
        </ul>
    </li>
@endif