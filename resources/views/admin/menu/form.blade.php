<div class="form-group">
    <label for="menu_nombre" class="col-lg-3 control-label requerido">Nombre</label>
    <div class="col-lg-8">
    <input type="text" name="menu_nombre"  id="menu_nombre" class="form-control" value="{{old('menu_nombre', $data->menu_nombre ?? '')}}" required/>
    </div>
  </div>
  <div class="form-group">
    <label for="menu_url" class="col-lg-3 control-label requerido">Url</label>
    <div class="col-lg-8">
    <input type="text" name="menu_url"  id="menu_url" class="form-control" value="{{old('menu_url', $data->menu_url ?? '')}}" required/>
    </div>
  </div>
  <div class="form-group">
    <label for="menu_icono" class="col-lg-3 control-label ">Icono</label>
    <div class="col-lg-8">
    <input type="text" name="menu_icono"  id="menu_icono" class="form-control" value="{{old('menu_icono', $data->menu_icono ?? '')}}" />
    </div>

  </div>