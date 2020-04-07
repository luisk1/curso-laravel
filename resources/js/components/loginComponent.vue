<template>
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">LOGIN USUARIO</h3>
        </div>
        <div class="login-box">
          <div class="login-logo">
            <a href="">LOGIN USUARIO</a>
          </div>
          <!-- /.login-logo -->
          <div class="login-box-body">
            <p class="login-box-msg">Inicie su sesion</p>
           
              <div class="form-group has-feedback">
                <input
                  type="text"
                
                  class="form-control"
                  value=""
                  placeholder="usuario"
                  v-model="usua_datos"
                />
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input
                  type="password"
                  
                  class="form-control"
                  placeholder="Contraseña"
                  v-model="usua_pass"
                />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="row">
                <div class="col-xs-8"></div>
                <!-- /.col -->
                <div class="col-xs-4">
                  <button type="submit" @click="crear"   class="btn btn-primary btn-block btn-flat">Login</button>
                </div>
                <!-- /.col -->
              </div>
           
          </div>
          <!-- /.login-box-body -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      //
      //data: { usua_datos: "", usua_pass: "" },
      items: [],
      usua_datos: "",
      usua_pass: ""
    };
  },

  mounted() {
    console.log("Component mounted.");
    //this.cargar();
  },

  methods: {
    crear: function() {
      var input = this.data;
      //var myString = JSON.stringify(input);
      //console.log(myString);
      axios.post("login_post",{
        usua_datos:this.usua_datos,
        password:this.usua_pass
        })
        .then(response=>{
       swal('has iniciado sesion','datos correctos','admin/gestionarusuario');
        
      })
      .catch(error=>{
        let er = error.response.data.errors;
        let mensaje = "error no identificado";
        if(er.hasOwnProperty('usua_datos')){
          mensaje = er.usua_datos[0];
        }else if(er.hasOwnProperty('password')){
          mensaje = er.password[0];
        }else if(er.hasOwnProperty('login')){
          mensaje = er.login[0];
        }
        swal('error',mensaje,'error');
      });
    },
    //cargar: function cargar() {
      //var _this = this;

     // axios.get("/cargarrol").then(function(response) {
       // console.log("hechoaadsdas");
       // _this.items = response.data;
       // console.log(_this.items);
     // });
   // }
  }
};
</script>









