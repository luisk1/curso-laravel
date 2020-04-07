<template>
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Gestionar Orden X Cita</h3>
        </div>
        <form id="form-general" class="form-horizontal">
          <div class="box-body" v-if="valor">
            <div class="form-group">
              <div class="box-body table-responsive no-padding">
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <th style="text-align: center">FECHA CITA</th>
                      <th style="text-align: center">HORA CITA</th>
                      <th style="text-align: center">ACCIONES</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tr v-for="item in datas" v-bind:key="item.id">
                    <td align="center">{{item.cita_fecha}}</td>
                    <td align="center">{{item.cita_hora}}</td>
                    <td align="center" @click.prevent="cargarorden(item)" class="text-center btn btn-success ">
                      <span style="align:center" class="glyphicon glyphicon-floppy-disk"></span>
                    </td>
                    <!--<td><button @click.prevent="" class="btn btn-success btn-sm">EDITAR</button>
                        //<button @click.prevent="" class="btn btn-danger btn-sm">ELIMINAR</button>
                    //</td>-->
                  </tr>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="box box-danger" v-if="!valor">
          <div class="box-header with-border">
          <h3 class="box-title">Anexar OC a Cita</h3>
        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-bordered table-hover table-striped">
            <thead>
              <tr>
                <th style="text-align: center">NUMERO DE OC</th>
                <th style="text-align: center">NOMBRE DEL PROVEEDOR</th>
                <th style="text-align: center">ACCIONES</th>
                <th></th>
              </tr>
            </thead>
            <tr v-for="item in ordenes" v-bind:key="item.orden_id">
              <td align="center">{{item.orden}}</td>
              <td align="center">{{item.orden_nombreproveedor}}</td>
              <td @click.prevent="anexarOC(item)" class="btn btn-success">
                <span class="glyphicon glyphicon-floppy-disk"></span>
              </td>
              <!--<td><button @click.prevent="" class="btn btn-success btn-sm">EDITAR</button>
                        //<button @click.prevent="" class="btn btn-danger btn-sm">ELIMINAR</button>
              //</td>-->
            </tr>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import moment from "moment";
import es from "vuejs-datepicker/dist/locale";
export default {
  components: { Datepicker },
  data() {
    return {
      datos: { fecha: "", hora: "" },
      showModal: false,
      valor: true,
      es: es,
            datas: [],
            citas: [],
            ordenes: [],
      horaseleccionada: "",
      fechaseleccionada: "",
      date: "",
            id: "",
      e_numero: "",
      e_nombrepro: "",
      idcita: ""
    };
  },
  mounted() {
    console.log("Component mounted.");
    this.cargarcita();
  },
  methods: {
      anexarOC: function(item) {
      var _this = this;
      axios
        .post("guardarordencita/", { val1: _this.id, val2: item.orden })
        .then(function(response) {
          swal("mensaje", "OC anexada a cita con exito", "success");
          _this.cargarorden(_this.citas[0]);
        });
    },
    
    cargarcita: function cargarcita() {
      var _this = this;
      axios.get("citadisponible").then(function(response) {
        _this.datas = response.data;
      });
    },
    cargarorden: function cargarorden(item) {
      var _this = this;
      _this.valor = false;
      console.log('item');
      console.log(item);
      _this.citas.splice(0,_this.citas.length);
      _this.citas.push(item);
      console.log('_this.citas');
      console.log(_this.citas);
      console.log('_this.citas[0].id');
      console.log(_this.citas[0].id);
      _this.id = _this.citas[0].id;
      axios.get("ordendisponible").then(function(response) {
        _this.ordenes = response.data;
      });
    },

    
  }
};
</script>