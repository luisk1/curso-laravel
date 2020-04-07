@if ($item["submenu"] == [])
<li class="dd-item dd3-item" data-id="{{$item["id"]}}">
    <div class="dd-handle dd3-handle"></div>
    <div class="dd3-content {{$item["menu_url"] == "javascript:;" ? "font-weight-bold" : ""}}">
        <a href="{{route('editar_menu', ['id' => $item["id"]])}}">{{$item["menu_nombre"] . " | Url -> " . $item["menu_url"]}} Icono -> <i style="font-size:20px;" class="fa fa-fw {{isset($item["menu_icono"]) ? $item["menu_icono"] : ""}}"></i></a>
        <a href="{{route('eliminar_menu', ['id' => $item["id"]])}}" class="eliminar-menu pull-right tooltipsC" title="Eliminar este menú"><i class="text-danger fa fa-trash-o"></i></a>
    </div>
</li>
@else
<li class="dd-item dd3-item" data-id="{{$item["id"]}}">
    <div class="dd-handle dd3-handle"></div>
    <div class="dd3-content {{$item["menu_url"] == "javascript:;" ? "font-weight-bold" : ""}}">
        <a href="{{route('editar_menu', ['id' => $item["id"]])}}">{{ $item["menu_nombre"] . " | Url -> " . $item["menu_url"]}} Icono -> <i style="font-size:20px;" class="fa fa-fw {{isset($item["menu_icono"]) ? $item["menu_icono"] : ""}}"></i></a>
        <a href="{{route('eliminar_menu', ['id' => $item["id"]])}}" class="eliminar-menu pull-right tooltipsC" title="Eliminar este menú"><i class="text-danger fa fa-trash-o"></i></a>
    </div>
    <ol class="dd-list">
        @foreach ($item["submenu"] as $submenu)
        @include("admin.menu.menu-item",[ "item" => $submenu ])
        @endforeach
    </ol>
</li>
@endif
