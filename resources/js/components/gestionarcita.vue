<template>
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Gestionar Citas</h3>
        </div>
        <form id="form-general" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="horacita" class="col-lg-3 control-label requerido">FECHA CITA DATEP</label>
              <div class="col-lg-8">
                <datepicker
                  :bootstrap-styling="true"
                  input-class="form-control"
                  id="fecha"
                  :open-date="openDate"
                  :format="customFormatter"
                  :lang="es"
                  :disabled-dates="{ to: new Date() }"
                  @change="onChange()"
                  @selected="fechaSeleccionada"
                  v-model="event_at"
                ></datepicker>
              </div>
            </div>
            <div class="form-group">
              <label for="horacita" class="col-lg-3 control-label requerido">HORA CITA</label>
              <div class="col-lg-3">
                <select v-model="horaseleccionada" class="form-control" id="horas">
                  <option disabled value>Seleccionar</option>
                  <option
                    v-for="item in horas"
                    :value="item.nombre"
                    v-bind:key="item.nombre"
                  >{{item.nombre}}</option>
                </select>
              </div>
            </div>

            <div class="box-footer">
              <div class="col-lg-3"></div>
              <div class="col-lg-6">
                <button @click.prevent="crear" class="btn btn-success" id="boton">Crear</button>
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
                <th>NUMERO DE OC</th>
                <th>NOMBRE DEL PROVEEDOR</th>
                <th>ACCIONES</th>
                <th></th>
              </tr>
            </thead>
            <tr v-for="item in datas" v-bind:key="item.orden_id">
              <td>{{item.orden}}</td>
              <td>{{item.orden_nombreproveedor}}</td>
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
      event_at: new Date(),
      openDate: new Date(),
      es: es,

      data1: [
        { nombre: "6:30" },
        { nombre: "7:30" },
        { nombre: "8:30" },
        { nombre: "9:30" },
        { nombre: "10:30" },
        { nombre: "11:30" },
        { nombre: "12" },
        { nombre: "13" },
        { nombre: "14:30" },
        { nombre: "15:30" },
        { nombre: "16:30" },
        { nombre: "17:30" },
        { nombre: "18:30" }
      ],
      datas: [],
      horas: [],
      datos: [],
      horaseleccionada: "",
      fechaseleccionada: "",
      date: "",
      e_id: "",
      e_numero: "",
      e_nombrepro: "",
      idcita: ""
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    customFormatter(date) {
      return moment(date).format("DD/MM/YYYY");
    },
    anexarOC: function(item) {
      var _this = this;
      axios
        .post("guardarordencita/", { val1: _this.idcita, val2: item.orden })
        .then(function(response) {
          swal("mensaje", "OC anexada a cita con exito", "success");
          _this.cargar();
        });
    },
    crear: function() {
      var input = this.datos;
      var _this = this;
      axios
        .post("guardarcita/", {
          val1: _this.fechaseleccionada,
          val2: _this.horaseleccionada
        })
        .then(function(response) {
          _this.idcita = response.data.resp.id;
          swal("mensaje", "Cita creada con exito", "success");
          _this.horas.length = 0;
          _this.cargar();
        });
    },
    buscar: function() {
      var _this = this;
      var fec = document.getElementById("date").value;
      var fecha = $("#date").val();
      _this.date = fec;
    },

    cargar: function cargar() {
      var _this = this;
      axios.get("ordendisponible").then(function(response) {
        _this.datas = response.data;
      });
    },

    datepickerAbierto: function() {
      console.log("El datepicker ha sido abierto");
    },
    fechaSeleccionada: function(val) {
      var _this = this;
      _this.horas.length = 0;
      var fec = moment(val).format("YYYY-MM-DD");
      _this.fechaseleccionada = moment(val).format("YYYY-MM-DD");
      axios.get("buscarfecha/" + fec).then(function(response) {
        _this.datos = response.data;
        for (var i in _this.data1) {
          var x = 0;
          for (var u in _this.datos) {
            if (_this.data1[i].nombre == _this.datos[u].cita_hora) {
              var x = 1;
            }
          }
          if (x == 0) {
            _this.horas.push(_this.data1[i]);
          }
        }
      });
    },
    datepickerCerrado: function() {
      console.log("El datepicker ha sido cerrado");
    }
  }
};
</script>