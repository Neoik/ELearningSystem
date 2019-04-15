<template>
    <div class="container">
        <div class="container">
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
            <button v-on:click="create_problem" class="btn btn-success">Create!</button>
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
            };
        },
        methods: {
            create_problem: function() {
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
                    if (response.data['next']){
                        window.location.href = response.data['next'];
                    }
                }).catch(function (error) {
                    if (error.response.data['errors']) {
                        let errors = error.response.data['errors']
                        _this.errors = errors
                    }
                });
            },
            clear_errors: function (field) {
                this.$set(this.errors, field, null)
            },
        },
        mounted() {
            //this.create_problem();
        }
    }
</script>
