<template>
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Gestionar Roles</h3>
        </div>
        <form id="form-general" class="form-horizontal">
          <div v-if="!actualiza" class="box-body">
            <table class="table table-striped table-bordered table-hover" id="tabla-data">
              <thead>
                <tr>
                  
                  <th>Nombre</th>
                  <th class="width70"></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="rol in datas" :key="rol.id">
                  
                  <td>{{ rol.nombre }}</td>
                  <td
                    id="show-modal"
                    @click="
                                            showModal = true;
                                            setVal(rol.id,rol.nombre);
                                        "
                    class="btn btn-info"
                  >
                    <span class="glyphicon glyphicon-pencil"></span>
                  </td>
                  <td @click.prevent="deleteItem(rol)" class="btn btn-danger">
                    <span class="glyphicon glyphicon-trash"></span>
                  </td>
                </tr>
              </tbody>
            </table>
            <button @click="actualiza=true" class="btn btn-danger">Crear</button>
          </div>

          <form v-if="actualiza" id="form-general" class="form-horizontal">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Roles</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <div class="box-header with-border">
                  <label for="nombrerol" class="col-lg-3 control-label requerido">Nombre Rol</label>
                  <div class="col-lg-8">
                    <input
                      type="text"
                      name="nombrerol"
                      id="nombrerol"
                      class="form-control"
                      v-model="datos.nombre"
                      required
                    />
                  </div>
                </div>
                <div class="box-header with-border">
                  <div class="box-footer">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                      <button type="reset" class="btn btn-default" @click="actualiza = false">Cancel</button>
                      <button @click.prevent="crear" type="submit" class="btn btn-success">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>

          <modal v-if="showModal" @close="showModal = false">
            <h3 slot="header">Editar Rol</h3>
            <div slot="body">
              console.log('hola'),
              <input
                type="hidden"
                disabled
                class="form-control"
                id="e_id"
                name="id"
                required
                :value="this.e_id"
              />
              Nombre:
              <input
                type="text"
                class="form-control"
                id="e_nombre"
                name="nombre"
                required
                :value="this.e_nombre"
              />
            </div>
            <div slot="footer">
              <button class="btn btn-default" @click="showModal = false">Cancel</button>
              <button class="btn btn-info" @click="editItem()">Actualizar</button>
            </div>
          </modal>
          <!--- <modal v-if="actualiza" @close="actualiza=false">
                        <h3 slot="header">Crear Rol</h3>
                        <div slot="body">
                            console.log('hola'),
                        Nombre: <input type="text" class="form-control" id="ef_nombre" name="nombre"   :value="this.ef_nombre">
                        </div>
                        console.log('hola'),
                          <div slot="footer">
                        <button class="btn btn-default" @click="actualiza = false">
                        Cancel
                      </button>                      
                      <button class="btn btn-info" @click="editItem()">
                        Actualizar
                      </button>
                    </div>

          </modal>--->
        </form>
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
      datos: { nombre: "" },
      showModal: false,
      actualiza: false,
      cedulas: { cedula: "" },
      pass: { pass: "" },
      nombre: "",
      e_id: '',
      e_nombre: '',
      nombrerol: '',
      datas: []
    };
  },
  mounted() {
    console.log("Component mounted.");
    this.cargar();
  },
  methods: {
    cargar: function cargar() {
      var _this = this;
      axios.get("cargarrol").then(function(response) {
        _this.datas = response.data;
      });
    },
    editItem: function(){
    				var _this = this;
                    var id = document.getElementById('e_id').value;
        var n_val = document.getElementById('e_nombre').value; 
        console.log(id);
               console.log(id);
               console.log(id);
               console.log(id);
               console.log(n_val);
            
              		axios.put('rol/editar/' + id ,{nombre: n_val}).then(response=>{
                    //_this.cargar();
                    _this.datos = response.data;
                    //console.log(_this.datos);
    				//_this.showModal=false

                    
    		}).catch(error => {
          let er = error.response.data.errors;
          let mensaje = "error no identificado";
          if (er.hasOwnProperty("nombre")) {
            mensaje = er.nombre[0];
          } 
          swal("error", mensaje, "error");
        });	
    	},
    setVal(id,nombre) {
      this.e_id = id;
         this.e_nombre = nombre;
    },
    crear: function() {
      var _this = this;
      var input = this.datos;
      console.log(input.nombre);
      axios
        .post("rol", {
          nombre: input.nombre,
          })
        .then(function(response) {
          _this.nombre="";
          
          swal("rol creado con exito", "datos correctos");
          _this.cargar();
          _this.actualiza=false;
        })
        .catch(error => {
          let er = error.response.data.errors;
          let mensaje = "error no identificado";
          if (er.hasOwnProperty("nombre")) {
            mensaje = er.nombre[0];
          } 
          swal("error", mensaje, "error");
        });
    },
    deleteItem: function deleteItem(item){
        var _this = this;
        axios.delete('rol/eliminar/' + item.id).then(function(response){
            _this.cargar();
            swal("Dato eliminado correctamente");
    		}).catch(error => {
          let er = error.response.data.errors;
          
          swal("error", er, "error");
        });	
    	},
    buscar: function() {
      //axios.get('/buscar/'+ cedula +'/'+ pa.pass).then(function (response){
      //console.log(response.data);
      //_this.datas = response.data;
      //});--->
      //this.actualiza=true;
    }
  }
};
</script>
