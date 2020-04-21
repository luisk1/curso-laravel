<template>
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Gestionar Usuario</h3>
        </div>
        <form id="form-general" class="form-horizontal">
          <div class="box-body">
            <b-alert
              v-if="bandera!=false"
              :show="dismissCountDown"
              dismissible
              variant="danger"
              @dismiss-count-down="countDownChanged"
            >
              <h4>
                <i class="icon fa fa-check"></i> Por favor, corrija el(los) siguiente(s) error(es):
              </h4>
              <ul>
                <li v-for="error in errores" v-bind:key="error.cedula">{{ error[0] }}</li>
              </ul>
            </b-alert>
            <div class="form-group">
              <ValidationProvider rules="required|alpha_spaces" v-slot="{errors}">
                <label for="nombre" class="col-lg-3 control-label requerido">Nombre</label>
                <div class="col-lg-8">
                  <input
                    type="text"
                    name="nombre"
                    id="nombre"
                    class="form-control"
                    v-model="datos.usua_datos.nombre"
                  />
                  <div>
                    <p style="color:#FF0000">{{ errors[0] }}</p>
                  </div>
                </div>
              </ValidationProvider>
            </div>

            <div class="form-group">
              <ValidationProvider rules="required|alpha_spaces" v-slot="{errors}">
                <label for="apellido" class="col-lg-3 control-label requerido">Apellido</label>
                <div class="col-lg-8">
                  <input
                    type="text"
                    name="apellido"
                    id="apellido"
                    class="form-control"
                    v-model="datos.usua_datos.apellido"
                  />
                  <div>
                    <p style="color:#FF0000">{{ errors[0] }}</p>
                  </div>
                </div>
              </ValidationProvider>
            </div>

            <div class="form-group">
              <ValidationProvider rules="required|numeric" v-slot="{errors}">
                <label for="cedula" class="col-lg-3 control-label requerido">Cedula</label>
                <div class="col-lg-8">
                  <input
                    type="number"
                    name="cedula"
                    id="cedula"
                    class="form-control"
                    v-model="datos.cedula"
                  />
                  <div>
                    <p style="color:#FF0000">{{ errors[0] }}</p>
                  </div>
                </div>
              </ValidationProvider>
            </div>

            <div class="form-group">
              <ValidationProvider rules="required|email" v-slot="{errors}">
                <label for="correo" class="col-lg-3 control-label">Correo</label>
                <div class="col-lg-8">
                  <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    v-model="datos.usua_datos.email"
                  />
                  <div>
                    <p style="color:#FF0000">{{ errors[0] }}</p>
                  </div>
                </div>
              </ValidationProvider>
            </div>

            <div class="form-group" v-if="verifi">
              <ValidationProvider rules="required|alpha_spaces" v-slot="{errors}">
                <label for="transportadora" class="col-lg-3 control-label">Transportadora</label>
                <div class="col-lg-8">
                  <input
                    type="text"
                    name="transportadora"
                    id="transportadora"
                    class="form-control"
                    v-model="datos.usua_datos.transportadora"
                  />
                  <div>
                    <p style="color:#FF0000">{{ errors[0] }}</p>
                  </div>
                </div>
              </ValidationProvider>
            </div>

            <div class="form-group">
              <ValidationProvider rules="required|alpha_dash" v-slot="{errors}">
                <label for="password" class="col-lg-3 control-label">Password</label>
                <div class="col-lg-8">
                  <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    v-model="datos.password"
                  />
                  <div>
                    <p style="color:#FF0000">{{ errors[0] }}</p>
                  </div>
                </div>
              </ValidationProvider>
            </div>

            <div class="box-footer">
              <div class="col-lg-3"></div>
              <div class="col-lg-6">
                <button @click.prevent="crear" class="btn btn-success">Crear</button>
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
      dismissCountDown: null,
      datos: {
        cedula: "",
        password: "",
        usua_datos: { nombre: "",email: "", apellido: "", transportadora: "" }
      },
      actualiza: false,
      verifi: false,
      bandera: false,
      cedula: "",
      e_numero: "",
      datas: [],
      errores: {}
    };
  },
  mounted() {
    console.log("Component mounted.");
    this.verifica();
    //this.showAlert();
  },
  methods: {
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown;
    },
    crear: function() {
      var input = this.datos;
      var _this = this;
      _this.errores = {};
      _this.dismissCountDown = 7;
      var myString = JSON.stringify(_this.datos);
      console.log(input);
      axios
        .post("crearusuario", {
          "cedula": input.cedula,
          "usua_datos": input.usua_datos,
          "email": input.email,
          "password": input.password
        })
        .then(function(response) {
          if(response.data!=null){
            toastr.success("usuario creado con exito");
          location.reload(true/false); 
          }          
        })
        .catch(error => {
          if(error.response!=null){
            console.log(error.response);
          _this.errores = error.response.data.errors;
          console.log(_this.errores);
          _this.bandera=true;
          }
          
        });
    },
    verifica: function() {
      var _this = this;
      axios.get("verificarsesion").then(function(response) {
        if (response.data != "") {
          _this.verifi = false;
        } else {
          _this.verifi = true;
        }
      });
    }
  }
};
</script>