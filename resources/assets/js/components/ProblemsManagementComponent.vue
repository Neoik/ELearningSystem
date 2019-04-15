<template>
    <div class="container">
        <div class="row justify-content-center">
            <table class="table table-sm">
                <tbody>
                <tr v-for="(problem_name, problem_id) in problems_info">
                    <td style="width: 10%">
                        {{ problem_id }}
                    </td>
                    <td style="width: 85%">
                        {{ problem_name }}
                    </td>
                    <td style="width: 0%">
                        <button v-on:click="edit_problem(problem_id)"type="button" class="btn btn-secondary">Edit</button>
                    </td>
                    <td style="width: 0%">
                        <button v-on:click="delete_problem(problem_id)"type="button" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    <button v-on:click="create_problem()" class="btn btn-success" id="problem_adder" title="add new problem">Add</button>
    </div>
</template>

<script>
    const axios = require('axios');
    export default {
        data: function(){
            return {
                problems_info: {},
            };
        },
        methods: {
            edit_problem: function (problem_id) {
                window.location.href = '/problems/update/problem/' + problem_id
            },
            delete_problem: function (problem_id) {
                this.$delete(this.problems_info, problem_id)
                let params = {
                    'id': problem_id,
                }

                var _this = this
                let problem_delete_path = '/problems/delete/problem/' + problem_id
                axios.post(problem_delete_path, params).then(function (responce) {
                    console.log(responce.data)
                })
            },
            create_problem: function() {
                location.href = '/problems/create/problem'
            },
        },
        mounted() {
            let short_info_path = '/problems/info/short/'

            var _this = this;
            axios.get(short_info_path).then(function (response) {
                for(let problem_info of response.data) {
                    _this.$set(_this.problems_info, problem_info.id, problem_info.name)
                }
            });
            console.log(this.problems_info)
        }
    }
</script>

<style>
#problem_adder {
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 99;
    padding: 15px;
}
</style>
