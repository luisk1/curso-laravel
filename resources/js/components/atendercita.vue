<template>
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Crear Menus</h3>
          <a  @click.prevent="redirect" class="btn btn-info btn-sm pull-right">Listado</a>
         
        </div>
        <form id="form-general" class="form-horizontal">
          <div class="box-body">

 
             <div class="form-group">  
              <label for="menu_nombre" class="col-lg-3 control-label requerido">Nombre</label>
              <div class="col-lg-8">
                <input
                  type="text"
                  name="menu_nombre"
                  id="menu_nombre"
                  class="form-control"
                  v-model="datos.menu_nombre"
                />
              </div>
             </div>
              


            <div class="form-group">
              <label for="menu_url" class="col-lg-3 control-label requerido">Url</label>
              <div class="col-lg-8">
                <input
                  type="text"
                  name="menu_url"
                  id="menu_url"
                  class="form-control"
                  v-model="datos.menu_url"
                  required
                />
              </div>
            </div>
            <div class="form-group">
              <label for="menu_icono" class="col-lg-3 control-label">Icono</label>
              <div class="col-lg-8">
                <input
                  type="text"
                  name="menu_icono"
                  id="menu_icono"
                  class="form-control"
                  v-model="datos.menu_icono"
                />
              </div>
            </div>
          </div>
          <div class="box-footer">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
              <button type="reset" class="btn btn-default">Cancel</button>
              <button @click.prevent="crear"  class="btn btn-success">Guardar</button>
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
      datos: { menu_nombre: "", menu_url: "", menu_icono: "" },
      showModal: false,
      datas: [],
      datos1: [],
      e_id: "",
      e_numero: "",
      e_nombrepro: ""
    };
  },
  mounted() {
    console.log("Component mounted.");
    //this.cargar();
  },
  methods: {
    crear: function() {
      var input = this.datos;
      var _this = this;
      var myString = JSON.stringify(input);
      console.log(myString);
      axios.post("menu1", {
          menu_nombre: input.menu_nombre,
          menu_url: input.menu_url,
          menu_icono: input.menu_icono
        })
        .then(function(response) {
          _this.datos = { nombre: "", url: "", icono: "" };
          swal("menu creado con exito", "datos correctos");
          //_this.redirect();
        })
        .catch(error => {
          let er = error.response.data.errors;
          let mensaje = "error no identificado";
          if (er.hasOwnProperty("menu_nombre")) {
            mensaje = er.menu_nombre[0];
          } else if (er.hasOwnProperty("menu_url")) {
            mensaje = er.menu_url[0];
          } else if (er.hasOwnProperty("menu_icono")) {
            mensaje = er.menu_icono[0];
          }
          swal("error", mensaje, "error");
        });
    },
    buscar: function() {
      var i;
      var obj1 = { a: 1, b: 2, c: true };
      var obj2 = { c: true, b: 2, a: 1 };
      for (i in obj1) {
        console.assert(obj1[i] === obj2[i]);
        console.log(i);
      }
      for (i in obj2) {
        console.assert(obj1[i] === obj2[i]);
      }
    },

    editItem: function() {
      var _this = this;
      var i_val = document.getElementById("e_id").value;
      var n_val = document.getElementById("e_numero").value;
      var a_val = document.getElementById("e_nombrepro").value;
      axios
        .put("/editarorden/" + i_val, { val1: n_val, val2: a_val })
        .then(response => {
          _this.cargar();
          _this.datos = response.data;
          console.log(_this.datos);
          _this.showModal = false;
        });
    },

    setVal(id, numero, nombre) {
      this.e_id = id;
      this.e_numero = numero;
      this.e_nombrepro = nombre;
    },
    deleteItem: function deleteItem(item) {
      var _this = this;
      console.log(item);
      axios.post("/eliminarorden/" + item.orden_id).then(function(response) {
        _this.cargar();
      });
    },
    redirect: function redirect() {
      var _this = this;
      axios.get("menu");
    },

    cargar: function cargar() {
      var _this = this;
      axios.get("/cargarorden").then(function(response) {
        _this.datas = response.data;
      });
    }
  }
};
</script>
