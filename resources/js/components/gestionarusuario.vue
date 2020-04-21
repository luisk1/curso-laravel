<template>
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Gestionar Usuario</h3>
        </div>
        <form id="form-general" class="form-horizontal" v-if="!verifi">
          <div class="box-body">
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

            <div class="box-footer">
              <div class="col-lg-3"></div>
              <div class="col-lg-6">
                <button @click.prevent="actualizar" class="btn btn-success">Actualizar</button>
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
      datos: {
        cedula: "",
        pass: "",
        usua_datos: { nombre: "", apellido: "", email: "", transportadora: "" }
      },
      showModal: false,
      actualiza: false,
      verifi: false,
      cedulas: { cedula: "" },
      pass: { pass: "" },
      cedula: "",
      e_numero: "",
      id: "",
      datas: [],
      recibido: {}
    };
  },
  mounted() {
    console.log("Component mounted.");
    this.cargar();
  },
  methods: {
    actualizar: function() {
      var input = this.datos;
      var _this = this;
      axios.put("editarusuario/" + _this.id, input).then(response => {
        toastr.success("datos actualizados con exito");
      });
    },
    cargar: function cargar() {
      var _this = this;
      axios.get("cargarusuario").then(function(response) {
        _this.datas = response.data[0];
        _this.datos.cedula = _this.datas["cedula"];
        _this.recibido = jQuery.parseJSON(_this.datas["usua_datos"]);
        _this.datos.usua_datos.nombre = _this.recibido.nombre;
        _this.datos.usua_datos.apellido = _this.recibido.apellido;
        _this.datos.usua_datos.email = _this.recibido.email;
        _this.id = _this.datas.id;
      });
    }
  }
};
</script>