<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <highlight-code lang="java" v-if="sumbission">
                {{sumbission['source']}}
            </highlight-code>
            </div>

             <div class="col-md-6">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Test_id#</th>
                    <th scope="col">Status</th>
                    <th scope="col">Additonal info</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(sumbission_test,index) in sumbission['tests']">
                    <td>
                      {{ index+1 }}
                    </td>
                    <td v-if="sumbission_test[0] == 0" class="text-primary">
                      {{ status2msg(sumbission_test[0]) }}
                    </td>
                    <td v-else-if="sumbission_test[0] == 1" class="text-success">
                      {{ status2msg(sumbission_test[0]) }}
                    </td>
                    <td v-else class="text-danger">
                      {{ status2msg(sumbission_test[0]) }}
                    </td>
                    <td>
                      {{ sumbission_test[1] }}
                    </td>
                  </tr>
                </tbody>
              </table>
              </div>
          </div>
    </div>
</template>

<script>
    const axios = require('axios');
export default {
  data: function(){
    let s2m = {
      0: "Processing",
      1: "Accepted",
      2: "Memory limit exceeded",
      3: "Time limit exceeded",
      4: "Compilation error",
      5: "Runtime error",
      6: "Wrong answer",
    }
    return {
        sumbission: null,
        status2msg: function(status_code) {
          return s2m[status_code]
        },
        status: -1,
        interval: null,
    };
  },
  methods: {
    update_submission: function() {
        var _this = this;

        axios.get(window.location.pathname + '/json').then(function (response) {
            let sumbission = response.data;
            if(sumbission['status'] != 0 && _this.interval) {
                clearInterval(_this.interval);
            }
            return _this.sumbission = response.data;
        }).catch(function (error) {
            console.log(error);
        });
    },
  },
  mounted() {
      this.update_submission()
      this._data.interval = setInterval(this.update_submission, 1000)
  }
}
</script>
