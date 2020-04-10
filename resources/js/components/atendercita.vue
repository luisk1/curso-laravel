<template>
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-danger" v-if="valor">
        <div class="box-header with-border" >
          <h3 class="box-title">Atender Cita</h3>
          <a @click.prevent="redirect" class="btn btn-info btn-sm pull-right">Terminar Cita</a>
        </div>
        <div class="form-group">
          <div class="box-body table-responsive no-padding">
            <table class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th style="text-align: center">FECHA CITA</th>
                  <th style="text-align: center">HORA CITA</th>
                  <th style="text-align: center">ESTADO CITA</th>
                  <th style="text-align: center">ATENDER CITA</th>
                  <th></th>
                </tr>
              </thead>
              <tr v-for="item in citasasignadas" v-bind:key="item.orden_id">
                <td align="center">{{item.cita_fecha}}</td>
                <td align="center">{{item.cita_hora}}</td>
                <td align="center">{{item.cita_estado}}</td>
                <td @click.prevent="atender(item)" class="btn btn-success">
                  <span class="glyphicon glyphicon-pencil"></span>
                </td>
              </tr>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>

        <div class="box box-danger" v-if="!valor">
        <div class="box-header with-border" >
          <h3 class="box-title">Terminar Cita</h3>
          <a @click.prevent="redirect1" class="btn btn-info btn-sm pull-right">Atender Cita</a>
        </div>
        <div class="form-group">
          <div class="box-body table-responsive no-padding">
            <table class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th style="text-align: center">FECHA CITA</th>
                  <th style="text-align: center">HORA CITA</th>
                  <th style="text-align: center">ESTADO CITA</th>
                  <th style="text-align: center">TERMINAR CITA</th>
                  <th></th>
                </tr>
              </thead>
              <tr v-for="item in citasterminar" v-bind:key="item.orden_id">
                <td align="center">{{item.cita_fecha}}</td>
                <td align="center">{{item.cita_hora}}</td>
                <td align="center">{{item.cita_estado}}</td>
                <td @click.prevent="terminar(item)" class="btn btn-success">
                  <span class="glyphicon glyphicon-pencil"></span>
                </td>
              </tr>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      valor: true,
      citasasignadas: [],
      citasterminar: []
    };
  },
  mounted() {
    console.log("Component mounted.");
    this.cargar();
  },
  methods: {
    atender: function atender(item) {
      var _this = this;
      axios.put("atendercita", item).then(response => {
        toastr.success("cita atendida con exito");
        console.log(response.data);
        _this.cargar();
      });
    },
    terminar: function terminar(item) {
      var _this = this;
      axios.put("terminarcita", item).then(response => {
        toastr.success("cita terminada con exito");
        console.log(response.data);
        _this.cargaratendido();
      });
    },
    redirect: function redirect() {
      var _this = this;
      _this.valor = false;
      var _this = this;
      
    },
    redirect1: function redirect1() {
      var _this = this;
      _this.valor = true;
      _this.cargaratendido();
    },
    cargar: function cargar() {
      var _this = this;
      axios.get("citaasignadamostrar").then(function(response) {
        _this.citasasignadas = response.data;
        console.log(_this.citasasignadas);
      });
    },
    cargaratendido: function cargaratendido() {
      var _this = this;
      axios.get("citaatendidamostrar").then(function(response) {
        _this.citasterminar = response.data;
        console.log(_this.citasterminar);
      });
    }
  }
};
</script>
