<template>
        
 <div class="row">
    <div class="col-lg-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Gestionar Orden de Compra</h3>
        </div>
        <form id="form-general" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="numeroorden" class="col-lg-3 control-label requerido">Numero de OC</label>
              <div class="col-lg-8">
                <input
                  type="number"
                  name="numeroorden"
                  id="numeroorden"
                  class="form-control"
                  required
                  v-model="datos.orden"
                />
              </div>
            </div>
            <div class="form-group">
              <label for="nombreproveedor" class="col-lg-3 control-label requerido">Nombre proveedor</label>
              <div class="col-lg-8">
                <input
                  type="text"
                  name="nombreproveedor"
                  id="nombreproveedor"
                  class="form-control"
                  required
                  v-model="datos.nombreproveedor"
                />
              </div>
            </div>

            <div class="box-footer">
              <div class="col-lg-3"></div>
              <div class="col-lg-6">
                <button @click.prevent="crear" class="btn btn-success">Crear</button>
                <button @click="buscar" class="btn btn-danger">Buscar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
              </div>

              
            </div>
          </div>
        </form>
      </div>

            <div class="box box-danger">
            <div class="box-body table-responsive no-padding">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                        <th>ID OC</th>
                      <th>NUMERO DE OC</th>
                      <th>NOMBRE DEL PROVEEDOR</th>
                      <th>ACCIONES</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tr v-for="item in datas" v-bind:key="item.orden_id">
                    <td>{{item.id}}</td>
                    <td>{{item.orden}}</td>
                    <td>{{item.orden_nombreproveedor}}</td>
                    <td id="show-modal" @click="showModal=true; setVal(item.id,item.orden_numero,item.orden_nombreproveedor)"  class="btn btn-info" ><span
                            class="glyphicon glyphicon-pencil"></span></td>
                            <td @click.prevent="deleteItem(item)" class="btn btn-danger"><span
                                class="glyphicon glyphicon-trash"></span></td>
                    <!--<td><button @click.prevent="" class="btn btn-success btn-sm">EDITAR</button>
                        //<button @click.prevent="" class="btn btn-danger btn-sm">ELIMINAR</button>
                    //</td>-->
                  </tr>
                  <tbody></tbody>
                </table>

                <nav>
                  <ul class="pagination">
                      <li v-if="pagination.pagina_actual>1">
                        <a href="#" @click.prevent="changePage(pagination.pagina_actual - 1)">
                          <span>Atras</span>
                        </a>
                      </li>

                      <li v-for="page in pagesNumber" v-bind:key="page.pagina_actual" v-bind:class="[ page == isActived ? 'active' : '']">
                        <a href="#" @click.prevent="changePage(page)">
                          {{page}}
                        </a>
                      </li>
                      
                      <li v-if="pagination.pagina_actual<pagination.ultima_pagina">
                        <a href="" @click.prevent="changePage(pagination.pagina_actual + 1)">
                          <span>siguiente</span>
                        </a>
                      </li>
                  </ul>
                </nav>

                        <modal v-if="showModal" @close="showModal=false">
                        <h3 slot="header">Edit Item</h3>
                        <div slot="body">
                        <input type="hidden" disabled class="form-control" id="e_id" name="id"
                                required  :value="this.e_id">
                        NUMERO DE OC: <input type="number" class="form-control" id="e_numero" name="numero" required  :value="this.e_numero">
                        NOMBRE PROVEEDOR: <input type="text" class="form-control" id="e_nombrepro" name="nombre"
                        required  :value="this.e_nombrepro">
                            </div>

                          <div slot="footer">
                        <button class="btn btn-default" @click="showModal = false">
                        Cancel
                      </button>
                      
                      <button class="btn btn-info" @click="editItem()">
                        Update
                      </button>
                    </div>

                    </modal>

              </div>
            </div>


            <script type="text/x-template" id="modal-template">
      <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">

              <div class="modal-header">
                <slot name="header">
                  default header
                </slot>
              </div>

              <div class="modal-body">
                <slot name="body">
                    
                </slot>
              </div>

              <div class="modal-footer">
                <slot name="footer">
                  
                  
                </slot>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </script>


    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      datos: { orden: "", nombreproveedor: "" },
      showModal: false,
      datas: [],
      datos1:[],
      e_id:'',
      e_numero:'',
      pagination:{
        'total':0,
        'pagina_actual':0,
        'por_pagina' :0,
        'ultima_pagina':0,
        'desde' :0,
        'hasta' :0,
      },
      e_nombrepro:''
    };
  },
  mounted() {
    console.log("Component mounted.");
    this.cargar();
  },
  computed:{
    isActived: function(){
      return this.pagination.pagina_actual;
    },
    pagesNumber: function(){
        if(!this.pagination.hasta){
          return [];
        }
        var from = this.pagination.pagina_actual - 2;
        if(from < 1){
          from = 1;
        }
        var to = from + (2*2);
        if(to >= this.pagination.ultima_pagina){
          to = this.pagination.ultima_pagina;
        }
        var pagesArray = [];
        while(from <= to){
            pagesArray.push(from);
            from++;
        }
        return pagesArray;
    }
  },
  methods: {
    crear: function() {
      
      var input = this.datos;
      var _this = this;
      var myString = JSON.stringify(input);
      axios.post("guardarorden/",{val1: input.orden, val2: input.nombreproveedor}).then(function(response) {
       swal("mensaje","OC creada con exito","success");
       _this.cargar();
       }).catch(error => {
          let er = error.response.data.respuesta;
          swal("error", er, "error");
      });
    },
    buscar: function() {
        var i;
var obj1 = {a: 1, b: 2, c: true};
var obj2 = {c: true, b: 2, a: 1};
for (i in obj1) {
    console.assert(obj1[i] === obj2[i]);
    console.log(i);
}
for (i in obj2) {
    console.assert(obj1[i] === obj2[i]);
}
    },

    editItem: function(){
    				var _this = this;
                    var i_val = document.getElementById('e_id').value;
    		var n_val = document.getElementById('e_numero').value;
        var a_val = document.getElementById('e_nombrepro').value;
        console.log(i_val);
  axios.put('editarorden/' + i_val ,{val1: n_val, val2: a_val}).then(response=>{
                    this.cargar();
                    _this.datos = response.data;
                    //console.log(_this.datos);
    				_this.showModal=false

                    
    		});	
    	},

    setVal(id,numero,nombre){
            this.e_id = id;
            this.e_numero = numero;
            this.e_nombrepro = nombre;
            console.log(this.e_id);
    },
    deleteItem: function deleteItem(item){
        var _this = this;
        console.log(item);
    		axios.post('eliminarorden/' + item.id).then(function(response){
    				_this.cargar();

    		});	
    	},

    cargar: function cargar(page){
            var _this = this;  
            _this.datos = {};
            var url = 'cargarorden?page='+page;
    		axios.get(url).then(function (response){
                console.log(response.data.pagination);
                toastr.success('cargo todo');
                    _this.datas = response.data.x.data;
                    _this.pagination = response.data.pagination;             		
    		});
      },
    changePage: function(page){
        this.pagination.pagina_actual = page;
        this.cargar(page);
    }
  }
};
</script>