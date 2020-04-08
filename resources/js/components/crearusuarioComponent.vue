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
            <div class="form-group">
              <label for="password" class="col-lg-3 control-label">Password</label>
              <div class="col-lg-8">
                <input type="password" name="password" id="password" class="form-control"  v-model="pass.pass"/>
              </div>
            </div>
            
            <div class="box-footer">
              <div class="col-lg-3"></div>
              <div class="col-lg-6">                
                <button  @click.prevent="crear" class="btn btn-success"> Crear   </button>
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
      datas: [],
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    crear: function() {
      console.log("ingreso111");
      var input = this.datos;
      var ced = this.cedulas;
      var pas = this.pass;
      var _this = this;
      var myString = JSON.stringify(input);
      axios.post('crearusuario/' + myString + '/' + pas.pass +'/' + ced.cedula,input).then(function(response) {
          _this.datos = { 'nombre': '', 'apellido': '', 'email': '' };
          _this.cedulas =  { 'cedula': '' } ;
          _this.pass = { 'pass': '' };
          toastr.success('usuario creado con exito');
        });
    },
    buscar: function(){
        //console.log("ingreso111");
        //var _this = this;
        //var input = this.datos;
        //var pa = this.pass;
        //var cedula = document.getElementById('cedula').value;
        //console.log(pa.pass);
        //console.log(input.cedula);
    		//axios.get('/buscar/'+ cedula +'/'+ pa.pass).then(function (response){
          //console.log(response.data);
    				//_this.datas = response.data;
    		
        //});--->
        //this.actualiza=true;
      },
      
  }, 
}
</script>