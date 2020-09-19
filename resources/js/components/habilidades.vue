<template>
    <div id="todo-list" class="container">
        <div class="row">
            <div class="col md-6 mx-auto">
                <h1 class="text-center">
                    Gerenciar Habilidades
                </h1>
                <form v-on:submit.prevent="addHabilidade">

                    <div class="form-group">
                        <label for="habilidade_input">Habilidade: </label>
                        <input type="text" v-model="habilidade" id="habilidade_input" class="form-control" placeholder="Digite a Habilidade" required/>
                    </div>

                    <button type="submit" v-if="this.isEdit == false" class="btn btn-success btn-block mt-3">Adicionar</button>
                    <button type="button" v-else v-on:click="updateHabilidade()" class="btn btn-primary btn-block mt-3">Update</button>
                </form>
                <p/>

                <table class="table">
                    <tr align="center">
                        <td>Habilidade</td>
                        <td colspan="2">Ações</td>
                    </tr>
                    <tr v-for="(habilidade) in habilidades" v-bind:key="habilidade.id" v-bind:habilidade_id="habilidade.id" class="text-center">
                        <td>{{ habilidade.habilidade }}</td>
                        <td>
                            <button type="button" v-on:click="editHabilidade(habilidade.habilidade, habilidade.id)" class="btn btn-info">Update</button>
                            <button type="button" v-on:click="deleteHabilidade(habilidade.id)" class="btn btn-danger">Delete</button>
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
            habilidades: [],
            habilidade: '',
            id: '',
            isEdit: false,
        }
    },

    mounted() {
        this.getHabilidades()
    },

    methods: {
        getHabilidades() {
            axios({method: 'GET', url: '/api/habilidades'}).then(
                result => {
                    console.log(result.data)
                    this.habilidades = result.data
                },
                error => {
                    console.error(error)    
                },
            )
            this.habilidade  = '',
            this.isEdit = false
        },
        addHabilidade() {
            axios.post('/api/habilidades', {
                    habilidade: this.habilidade
            }).then(res => {
                this.getHabilidades()
                console.log(res)
            })
            .catch(er => {
                console.log(err)
            })
        },
        editHabilidade(habilidade, id) {
            this.habilidade = habilidade
            this.id         = id
            this.isEdit     = true
        },
        updateHabilidade() {
            console.log(this.id)
            axios.put(`/api/habilidades/${this.id}`, {
                habilidade:   this.habilidade,
            }).then(res => {
                this.getHabilidades()
                console.log(res)
            })
            .catch(err => {
                console.log(err)
            })
        },
        deleteHabilidade(id) {
            axios.delete(`/api/habilidades/${this.id}`)
            .then(res => {
                this.getHabilidades()
                console.log(res)
            })
            .catch(err => {
                console.log(err)
            })
        },
    },
}
</script>
