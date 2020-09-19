<template>
    <div id="todo-list" class="container">
        <div class="row">
            <div class="col md-6 mx-auto">
                <h1 class="text-center">
                    Gerenciar Locals
                </h1>
                <form v-on:submit.prevent="addLocal">

                    <div class="form-group">
                        <label for="local_input">Local: </label>
                        <input type="text" v-model="local" id="local_input" class="form-control" placeholder="Digite o Local" required/>
                    </div>

                    <button type="submit" v-if="this.isEdit == false" class="btn btn-success btn-block mt-3">Adicionar</button>
                    <button type="button" v-else v-on:click="updateLocal()" class="btn btn-primary btn-block mt-3">Update</button>
                </form>
                <p/>

                <table class="table">
                    <tr align="center">
                        <td>Local</td>
                        <td colspan="2">Ações</td>
                    </tr>
                    <tr v-for="(local) in locals" v-bind:key="local.id" v-bind:local_id="local.id" class="text-center">
                        <td>{{ local.local }}</td>
                        <td>
                            <button type="button" v-on:click="editLocal(local.local, local.id)" class="btn btn-info">Update</button>
                            <button type="button" v-on:click="deleteLocal(local.id)" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            locals: [],
            local: '',
            id: '',
            isEdit: false,
        }
    },

    mounted() {
        this.getLocals()
    },

    methods: {
        getLocals() {
            axios({method: 'GET', url: '/api/locals'}).then(
                result => {
                    console.log(result.data)
                    this.locals = result.data
                },
                error => {
                    console.error(error)    
                },
            )
            this.local  = '',
            this.isEdit = false
        },
        addLocal() {
            axios.post('/api/locals', {
                    local: this.local
            }).then(res => {
                this.getLocals()
                console.log(res)
            })
            .catch(er => {
                console.log(err)
            })
        },
        editLocal(local, id) {
            this.local  = local
            this.id     = id
            this.isEdit = true
        },
        updateLocal() {
            console.log(this.id)
            axios.put(`/api/locals/${this.id}`, {
                local:   this.local,
            }).then(res => {
                this.getLocals()
                console.log(res)
            })
            .catch(err => {
                console.log(err)
            })
        },
        deleteLocal(id) {
            axios.delete(`/api/locals/${this.id}`)
            .then(res => {
                this.getLocals()
                console.log(res)
            })
            .catch(err => {
                console.log(err)
            })
        },
    },
}
</script>
