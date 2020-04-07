<template>
        
 <div class="row">
    <div class="col-lg-12" v-if="valor===0">
      <div class="box box-danger" >
        <div class="box-header with-border" >
          <h3 class="box-title">Reportes a Generar</h3>
        </div>
        <form id="form-general" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <div class="col-lg-3">
                <button @click.prevent="cambiar1()" class="btn btn-success">citas pendientes</button>
              </div>
              <div class="col-lg-3">
                <button @click.prevent="crear" class="btn btn-success">citas pendientes por fecha</button>
              </div>
              <div class="col-lg-3">
                <button @click.prevent="crear" class="btn btn-success">citas pendientes por usuario</button>
              </div>
              <div class="col-lg-2">
                <button @click.prevent="crear" class="btn btn-success">citas atendidas</button>
              </div>
            </div>

            <div class="form-group">
              <div class="col-lg-3">
                <button @click.prevent="crear" class="btn btn-success">citas atendidas por fecha</button>
              </div>
              <div class="col-lg-3">
                <button @click.prevent="crear" class="btn btn-success">OC creadas sin cita</button>
              </div>
              <div class="col-lg-3">
                <button @click.prevent="crear" class="btn btn-success">    Buscar OC      </button>
              </div>
              <div class="col-lg-2">
                <button @click.prevent="crear" class="btn btn-success">citas atendidas</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-12" v-if="valor===1">
      <div class="box box-danger" >
        <div class="box-header with-border" >
          <h3 class="box-title">Citas pendientes por fecha</h3>
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
              </tr>
            <tbody></tbody>
          </table>
        </div>
      </div>
            <div class="box-footer">
              <div class="col-lg-3"></div>
              <div class="col-lg-6">
                <button @click.prevent="buscar1" class="btn btn-success" id="boton">Buscar</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-12" v-if="valor===2">
      <div class="box box-danger" >
        <div class="box-header with-border" >
          <h3 class="box-title">Citas pendientes por fecha</h3>
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
                  v-model="event_at"
                ></datepicker>
              </div>
            </div>
            <div class="box-footer">
              <div class="col-lg-3"></div>
              <div class="col-lg-6">
                <button @click.prevent="buscars" class="btn btn-success" id="boton">Buscar</button>
              </div>
            </div>
          </div>
        </form>
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
        event_at: new Date(),
      openDate: new Date(),
      valor: 0,
      fechaseleccionada: "",
      es: es
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  
  methods: {
   customFormatter(date) {
      return moment(date).format("DD/MM/YYYY");
    },

    cambiar1: function() {
        var _this = this;
      _this.valor = 1;
    },
    buscar1: function(){
        var _this = this;
        console.log(_this.fechaseleccionada);
    },
    fechaSeleccionada: function(val) {
      var _this = this;
      var fec = moment(val).format("YYYY-MM-DD");
      _this.fechaseleccionada = moment(val).format("YYYY-MM-DD");
    }  
    
  }
};
</script>