<template>
    <div class="container">

        <div class="container">
            <h2>Problem details</h2>
            <div v-if="msg != null" class="alert alert-success">
                {{ msg }}
                <a  v-on:click="clear_msg()" href="#" class="close" aria-label="close">&times;</a>
            </div>

            <div class="form-group">
                <label for="p_name"><h4>Name</h4></label>
                <div v-if="errors['name']">
                    <div v-for="error in errors['name']" class="alert alert-danger alert-dismissible">
                        <a  v-on:click="clear_errors('name')" href="#" class="close" aria-label="close">&times;</a>
                        {{error}}
                    </div>
                </div>
                <input v-model="name" class="form-control" id="p_name" placeholder="Enter problem name">
            </div>

            <div class="form-group">
                <label for="p_description"><h4>Description</h4></label>
                <div v-if="errors['description']">
                    <div v-for="error in errors['description']" class="alert alert-danger alert-dismissible">
                        <a  v-on:click="clear_errors('description')" href="#" class="close" aria-label="close">&times;</a>
                        {{error}}
                    </div>
                </div>
                <textarea v-model="description" class="form-control" rows="5" id="p_description" placeholder="Enter problem description"></textarea>
            </div>

            <div class="form-group">
                <label for="p_input_description"><h4>Input description</h4></label>
                <div v-if="errors['input_description']">
                    <div v-for="error in errors['input_description']" class="alert alert-danger alert-dismissible">
                        <a  v-on:click="clear_errors('input_description')" href="#" class="close" aria-label="close">&times;</a>
                        {{error}}
                    </div>
                </div>
                <textarea v-model="input_description" class="form-control" rows="2" id="p_input_description" placeholder="Enter problem input description"></textarea>
            </div>

            <div class="form-group">
                <label for="p_output_description"><h4>Output description</h4></label>
                <div v-if="errors['output_description']">
                    <div v-for="error in errors['output_description']" class="alert alert-danger alert-dismissible">
                        <a  v-on:click="clear_errors('output_description')" href="#" class="close" aria-label="close">&times;</a>
                        {{error}}
                    </div>
                </div>
                <textarea v-model="output_description" class="form-control" rows="2" id="p_output_description" placeholder="Enter problem output description"></textarea>
            </div>

            <div class="form-group">
                <label for="p_max_mem"><h4>Maximum memory (in MB)</h4></label>
                <div v-if="errors['max_mem']">
                    <div v-for="error in errors['max_mem']" class="alert alert-danger alert-dismissible">
                        <a  v-on:click="clear_errors('max_mem')" href="#" class="close" aria-label="close">&times;</a>
                        {{error}}
                    </div>
                </div>
                <input v-model="max_mem" class="form-control" id="p_max_mem" placeholder="Enter maximum memory program can allocate">
            </div>

            <div class="form-group">
                <label for="p_max_time"><h4>Maximum execution time (in secons)</h4></label>
                <div v-if="errors['max_time']">
                    <div v-for="error in errors['max_time']" class="alert alert-danger alert-dismissible">
                        <a  v-on:click="clear_errors('max_time')" href="#" class="close" aria-label="close">&times;</a>
                        {{error}}
                    </div>
                </div>
                <input v-model="max_time" class="form-control" id="p_max_time" placeholder="Maximum time program can execute">
            </div>
            <button v-on:click="update_problem" class="btn btn-success">Update!</button>
        </div>


        <br><br><br>


        <div class="container">
            <h2>Problem input examples</h2>
            <div v-for="(example, example_id) in examples" class="my-container">
                <div v-if="update_example_errors[example_id]" class="form-group">
                    <div v-for="error in update_example_errors[example_id]" class="alert alert98 alert-danger alert-dismissible">
                        <a  v-on:click="clear_update_example_errors(example_id)" href="#add_example" class="close" aria-label="close">&times;</a>
                        {{error[0]}}
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-5">
                        <input type="text" class="form-control" v-model="example.input">
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" v-model="example.output">
                    </div>
                    <div class="col">
                        <button v-on:click="update_example(example_id)" type="button" class="btn btn-success">Update</button>
                        <button v-on:click="delete_example(example_id)" type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>

            <hr class="col-xs-12">
            <h4 id="add_example">Add new examples</h4>
            <div v-if="add_example_msg != null" class="alert alert98 alert-success">
                {{ add_example_msg }}
                <a  v-on:click="clear_add_example_msg()" href="#add_example" class="close" aria-label="close">&times;</a>
            </div>
            <div v-if="add_example_errors['input']">
                <div v-for="error in add_example_errors['input']" class="alert alert98 alert-danger alert-dismissible">
                    <a  v-on:click="clear_add_example_errors('input')" href="#add_example" class="close" aria-label="close">&times;</a>
                    {{error}}
                </div>
            </div>
            <div v-if="add_example_errors['output']">
                <div v-for="error in add_example_errors['output']" class="alert alert98 alert-danger alert-dismissible">
                    <a  v-on:click="clear_add_example_errors('output')" href="#add_example" class="close" aria-label="close">&times;</a>
                    {{error}}
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-5">
                    <input type="text" class="form-control" v-model="example_input" placeholder="Problem input">
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" v-model="example_output" placeholder="Expected problem input">
                </div>
                <div class="col text-center">
                    <button v-on:click="add_new_example" style="width: 75%;" type="button" class="btn btn-success">Add</button>
                </div>
            </div>
        </div>

        <br><br><br>

        <div class="container">
            <h2>Problem tests</h2>
            <div v-for="(test, test_id) in tests" class="my-container">
                <div v-if="update_test_errors[test_id]" class="form-group">
                    <div v-for="error in update_test_errors[test_id]" class="alert alert98 alert-danger alert-dismissible">
                        <a  v-on:click="clear_update_test_errors(test_id)" href="#add_example" class="close" aria-label="close">&times;</a>
                        {{error[0]}}
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-5">
                        <input type="text" class="form-control" v-model="test.input">
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" v-model="test.output">
                    </div>
                    <div class="col">
                        <button v-on:click="update_test(test_id)" type="button" class="btn btn-success">Update</button>
                        <button v-on:click="delete_test(test_id)" type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
            <hr class="col-xs-12">
            <h4 id="add_test">Add new test</h4>
            <div v-if="create_test_msg != null" class="alert alert98 alert-success">
                {{ create_test_msg }}
                <a  v-on:click="clear_create_test_msg()" href="#add_test" class="close" aria-label="close">&times;</a>
            </div>
            <div v-if="create_test_errors['input']">
                <div v-for="error in create_test_errors['input']" class="alert alert98 alert-danger alert-dismissible">
                    <a  v-on:click="clear_create_test_errors('input')" href="#add_test" class="close" aria-label="close">&times;</a>
                    {{error}}
                </div>
            </div>
            <div v-if="create_test_errors['output']">
                <div v-for="error in create_test_errors['output']" class="alert alert98 alert-danger alert-dismissible">
                    <a  v-on:click="clear_create_test_errors('output')" href="#add_test" class="close" aria-label="close">&times;</a>
                    {{error}}
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-5">
                    <input type="text" class="form-control" v-model="test_input" placeholder="Problem input">
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" v-model="test_output" placeholder="Expected problem input">
                </div>
                <div class="col text-center">
                    <button v-on:click="create_test" style="width: 75%;" type="button" class="btn btn-success">Add</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    const axios = require('axios');
    export default {
        data: function(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                name: '',
                description: '',
                input_description: '',
                output_description: '',
                max_mem: '',
                max_time: '',
                errors: {},
                add_example_errors: {},
                update_example_errors: {},
                create_test_errors: {},
                update_test_errors: {},
                msg: null,
                add_example_msg: null,
                update_example_msg: null,
                create_test_msg: null,
                update_test_msg: null,
                examples: {},
                example_input: null,
                example_output: null,
                tests: {},
                test_input: null,
                test_output: null,
                problem_id: null,
            };
        },
        methods: {
            update_problem: function() {
                var _this = this;
                let params = {
                    name: _this.name,
                    description: _this.description,
                    input_description: _this.input_description,
                    output_description: _this.output_description,
                    max_mem: _this.max_mem,
                    max_time: _this.max_time,
                }
                axios.post(window.location.pathname, params).then(function (response) {
                    _this.errors = {}
                    _this.msg = response.data['msg'];
                }).catch(function (error) {
                    if (error.response.data['errors']) {
                        let errors = error.response.data['errors']
                        _this.errors = errors
                        _this.msg = null
                    }
                });
            },
            clear_errors: function (field) {
                this.$set(this.errors, field, null)
            },
            clear_add_example_errors: function (field) {
                this.$set(this.add_example_errors, field, null)
            },
            clear_update_example_errors: function (example_id) {
                this.$set(this.update_example_errors, example_id, null)
            },
            clear_update_test_errors: function (test_id) {
                this.$set(this.update_test_errors, test_id, null)
            },
            clear_create_test_errors: function (field) {
                this.$set(this.create_test_errors, field, null)
            },
            clear_msg: function() {
                this.msg = null;
            },
            clear_add_example_msg: function() {
                this.add_example_msg = null;
            },
            clear_create_test_msg: function() {
                this.create_test_msg = null;
            },
            add_new_example: function() {

                let path = '/problems/create/problem/' + this.problem_id + '/example'
                let params = {
                    input: this.example_input,
                    output: this.example_output,
                }

                var _this = this;
                axios.post(path, params).then(function (response) {
                    _this.add_example_errors = {}
                    _this.add_example_msg = response.data['msg'];
                    let new_example_id = response.data['id'];
                    params['id'] = new_example_id;
                    _this.$set(_this.examples, new_example_id, params)
                }).catch(function (error) {
                    if (error.response.data['errors']) {
                        let errors = error.response.data['errors']
                        _this.add_example_errors = errors
                        _this.add_example_msg = null
                    }
                });
            },
            update_example: function(example_id) {
                let example = this.examples[example_id]
                let params = {
                    id: example_id,
                    input: example.input,
                    output: example.output,
                }
                let path = '/problems/update/problem/' + this.problem_id + '/example'
                var _this = this;
                axios.post(path, params).then(function (response) {
                    console.log(response.data, example_id, 'here')
                    _this.$delete(_this.update_example_errors, example_id)
                }).catch(function (error) {
                    console.log(error.responce)
                    if (error.response.data['errors']) {
                        let errors = error.response.data['errors']
                        _this.$set(_this.update_example_errors, example_id, errors)
                        console.log(errors, _this.update_example_errors)
                    }
                });
            },
            delete_example: function(example_id) {
                let path = '/problems/delete/problem/' + this.problem_id + '/example'
                let params = {
                    id: example_id,
                }
                var _this = this;
                axios.post(path, params).then(function (response) {
                    console.log(response.data, example_id, 'here')
                    _this.$delete(_this.examples, example_id)
                });
            },
            create_test: function() {
                let path = '/problems/create/problem/' + this.problem_id + '/test'
                let params = {
                    input: this.test_input,
                    output: this.test_output,
                }

                var _this = this;
                axios.post(path, params).then(function (response) {
                    _this.create_test_errors = {}
                    _this.create_test_msg = response.data['msg'];
                    let new_test_id = response.data['id'];
                    params['id'] = new_test_id;
                    _this.$set(_this.tests, new_test_id, params)
                }).catch(function (error) {
                    if (error.response.data['errors']) {
                        let errors = error.response.data['errors']
                        _this.create_test_errors = errors
                        _this.create_test_msg = null
                    }
                });
            },
            update_test: function(test_id) {
                let test = this.tests[test_id]
                let params = {
                    id: test_id,
                    input: test.input,
                    output: test.output,
                }
                let path = '/problems/update/problem/' + this.problem_id + '/test'
                var _this = this;
                axios.post(path, params).then(function (response) {
                    _this.$delete(_this.update_test_errors, test_id)
                }).catch(function (error) {
                    console.log(error.responce)
                    if (error.response.data['errors']) {
                        let errors = error.response.data['errors']
                        _this.$set(_this.update_test_errors, test_id, errors)
                    }
                });
            },
            delete_test: function(test_id) {
                let path = '/problems/delete/problem/' + this.problem_id + '/test'
                let params = {
                    id: test_id,
                }
                var _this = this;
                axios.post(path, params).then(function (response) {
                    _this.$delete(_this.tests, test_id)
                });
            },
        },
        mounted() {
            let problem_id = window.location.href.split('#')[0].split('/').slice(-1)[0].replace('#', '');
            this._data.problem_id = problem_id;

            let info_path = '/problems/info/problem/';

            var _this = this;
            let problem_info_path = info_path + problem_id;
            axios.get(problem_info_path).then(function (response) {
                let data = response.data;
                for (const key of Object.keys(data)) {
                    _this._data[key] = data[key];
                }
            })
            let problem_examples_path = problem_info_path + '/examples'
            axios.get(problem_examples_path).then(function (response) {
                let examples = response.data;
                for(let example of examples) {
                    _this.$set(_this.examples, example.id, example)
                }
            })
            let problem_tests_path = problem_info_path + '/tests'
            axios.get(problem_tests_path).then(function (response) {
                let tests = response.data;
                for(let test of tests) {
                    _this.$set(_this.tests, test.id, test)
                }
            })
        }
    }
</script>

<style>
    .form-row {
        margin-top: 1%;
    }
    .alert98 {
        width: 98%;
        margin-top: 1%;
    }
    .my-container {
        width: 100%;
        padding-right: 0px;
        padding-left: 0px;
        margin-right: auto;
        margin-left: auto;
    }
</style>
