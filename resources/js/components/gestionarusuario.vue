<template>
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Gestionar Usuario</h3>
        </div>
        <form id="form-general"  class="form-horizontal" v-if="!verifi">
          <div class="box-body">
            <div class="form-group">
              <label for="nombre" class="col-lg-3 control-label requerido">Nombre</label>
              <div class="col-lg-8">
                <input type="text" name="nombre" id="nombre" class="form-control"  v-model="datos.nombre"/>
              </div>
            </div>
            <div class="form-group">
              <label for="apellido" class="col-lg-3 control-label requerido">Apellido</label>
              <div class="col-lg-8">
                <input type="text" name="apellido" id="apellido" class="form-control"  v-model="datos.apellido" />
              </div>
            </div>
            <div class="form-group">
              <label for="cedula" class="col-lg-3 control-label requerido">Cedula</label>
              <div class="col-lg-8">
                <input type="number" name="cedula" id="cedula" class="form-control"  v-model="cedulas.cedula"/>
              </div>
            </div>
            <div class="form-group">
              <label for="correo" class="col-lg-3 control-label">Correo</label>
              <div class="col-lg-8">
                <input type="email" name="email" id="email" class="form-control"  v-model="datos.email"/>
              </div>
            </div>
            
            
            <div class="box-footer">
              <div class="col-lg-3"></div>
              <div class="col-lg-6">                
                <button  @click.prevent="actualizar" class="btn btn-success"> Actualizar   </button>
                </div>
            </div> 
          </div>
          </form>
          
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      datos: { 'nombre': '', 'apellido': '', 'email': '' },
      showModal: false,
      actualiza: false,
      verifi: false,
      cedulas: { 'cedula': '' },
      pass: { 'pass': '' },
      cedula: '',
      e_numero:'',
      id:'',
      datas: [],
      recibido:{},
    };
  },
  mounted() {
    console.log("Component mounted.");
    this.cargar();
  },
  methods: {
    
    actualizar: function(){
            var _this = this;
            
             //       var i_val = document.getElementById('e_id').value;
    		//var n_val = document.getElementById('e_numero').value;
        //var a_val = document.getElementById('e_nombrepro').value;
        var ced = _this.cedulas.cedula;
        var str = _this.datos;
        
  axios.put('editarusuario/' + _this.id ,{val1: ced, val2: str}).then(response=>{
                    //this.cargar();
                    _this.datos.nombre = "";
                    console.log(response.data);
    				//_this.showModal=false
    		});	
      },
      cargar: function cargar(){
          var _this = this;            
    		axios.get('cargarusuario').then(function (response){                
                    _this.datas = response.data[0];
                    _this.recibido =jQuery.parseJSON(_this.datas['usua_datos']);
                    _this.cedulas.cedula = _this.datas.cedula;
                    _this.datos.nombre = _this.recibido.nombre;
                    _this.datos.apellido = _this.recibido.apellido;
                    _this.datos.email = _this.recibido.email;
                    _this.id = _this.datas.id;
                     console.log(_this.datas);
                    console.log('entro logueado');                		
    		});
      },
  }, 
}
</script>