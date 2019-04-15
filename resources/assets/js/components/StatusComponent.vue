<template>
    <div class="container">
          <div class="row justify-content-center" v-if="sumbissions != null && sumbissions.length > 0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Sub_id#</th>
                <th scope="col">Date</th>
                <th scope="col">Problem</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="sumbission in sumbissions">
                <td>
                  {{ sumbission.id }}
                </td>
                <td>
                  {{ sumbission.created_at }}
                </td>
                <td>
                 <a v-bind:href="'/problems/'+sumbission.problem_id">{{ sumbission.problem_name }}</a>
                </td>
                <td v-if="sumbission.status == 0" class="text-primary">
                  {{ status2msg(sumbission.status) }}
                </td>
                <td v-else-if="sumbission.status == 1" class="text-success">
                  {{ status2msg(sumbission.status) }}
                </td>
                <td v-else class="text-danger">
                  {{ status2msg(sumbission.status) }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      <div class="row justify-content-center" v-else>No submissions yet</div>
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
      sumbissions: null,
        status2msg: function(status_code) {
          return s2m[status_code]
      }
    };
  },
  methods: {
    update_submissions: function() {
        axios.get('/status/recent').then(response => (this.sumbissions = response.data)).catch(function (error) {
                console.log(error);
        })
    },
  },
  mounted() {
      this.update_submissions()
      setInterval(this.update_submissions, 1000)
  }
}
</script>
