<template>
    <div id="todo-list" class="container">
        <div class="row">
            <div class="col md-6 mx-auto">
                <h1 class="text-center">
                    Gerenciar Vagas
                </h1>
                <form v-on:submit.prevent="addVaga">
                    <div class="form-group">
                        <label for="habilidade_id_select">Habilidade: </label>
                        <select v-model="habilidade_id" id="habilidade_id_select" class="form-control" placeholder="Selecione a Habilidade" required>
                            <option value="" style="color:red">SELECIONE</option>
                            <option v-for="(habilidade) in habilidades" :value="habilidade.id">
                                {{ habilidade.habilidade }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="local_id_select">Local: </label>
                        <select v-model="local_id" id="local_id_select" class="form-control" placeholder="Selecione o Local" required>
                            <option value="" style="color:red">SELECIONE</option>
                            <option v-for="(local) in locals" :value="local.id">
                                {{ local.local }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="radio_pj">Tipo de Contratação: </label>
                        <div class="radio">
                            <input type="radio" name="tipo_contratacao[]" id="radio_pj" value="PJ" v-model="tipo_contratacao" required>
                            &nbsp;
                            <label for="radio_pj">PJ</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            <input type="radio" name="tipo_contratacao[]" id="radio_clt" value="CLT" v-model="tipo_contratacao">
                            &nbsp;
                            <label for="radio_clt">CLT</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            <input type="radio" name="tipo_contratacao[]" id="radio_temporario" value="Temporário" v-model="tipo_contratacao">
                            &nbsp;
                            <label for="radio_temporario">Temporário</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            <input type="radio" name="tipo_contratacao[]" id="radio_estagiario" value="Estagiário" v-model="tipo_contratacao">
                            &nbsp;
                            <label for="radio_estagiario">Estagiário</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="budget_input">Budget: </label>
                        <input type="number" v-model="budget" id="budget_input" min="0" class="form-control" placeholder="Digite o Budget" step='0.01' required/>
                    </div>

                    <button type="submit" v-if="this.isEdit == false" class="btn btn-success btn-block mt-3">Adicionar</button>
                    <button type="button" v-else v-on:click="updateVaga()" class="btn btn-primary btn-block mt-3">Update</button>
                </form>
                <p/>

                <table class="table">
                    <tr align="center">
                        <td>Habilidade</td>
                        <td>Local</td>
                        <td>Tipo de Contatação</td>
                        <td>Budget</td>
                        <td colspan="2">Ações</td>
                    </tr>
                    <tr v-for="(vaga) in vagas" v-bind:key="vaga.id" v-bind:habilidade_id="vaga.habilidade_id" class="text-center">
                        <td>{{ vaga.habilidade.habilidade }}</td>
                        <td>{{ vaga.local.local }}</td>
                        <td>{{ vaga.tipo_contratacao }}</td>
                        <td class="text-right">{{ formatPrice(vaga.budget) }}</td>
                        <td>
                            <button type="button" v-on:click="editVaga(vaga.habilidade_id, vaga.local_id, vaga.tipo_contratacao, vaga.budget, vaga.id)" class="btn btn-info">Update</button>
                            <button type="button" v-on:click="deleteVaga(vaga.id)" class="btn btn-danger">Delete</button>
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
            vagas: [],
            id: '',
            habilidade_id: '',
            local_id: '',
            tipo_contratacao: '',
            budget: '',
            isEdit: false,

            habilidades: [],
            locals: []
        }
    },

    mounted() {
        this.getVagas(),
        this.getHabilidades(),
        this.getLocals()
    },

    methods: {
        getVagas() {
            axios({method: 'GET', url: '/api/vagas'}).then(
                result => {
                    console.log(result.data)
                    this.vagas = result.data
                },
                error => {
                    console.error(error)    
                },
            )
            this.habilidade_id      = '',
            this.local_id           = '',
            this.tipo_contratacao   = '',
            this.budget             = '',
            this.isEdit = false
        },
        addVaga() {
            axios.post('/api/vagas', {
                    habilidade_id:      this.habilidade_id, 
                    local_id:           this.local_id, 
                    tipo_contratacao:   this.tipo_contratacao,
                    budget:             this.budget
            }).then(res => {
                this.getVagas()
                console.log(res)
            })
            .catch(er => {
                console.log(err)
            })
        },
        editVaga(habilidade_id, local_id, tipo_contratacao, budget, id) {
            this.habilidade_id      = habilidade_id
            this.local_id           = local_id
            this.tipo_contratacao   = tipo_contratacao
            this.budget             = budget
            this.id     = id
            this.isEdit = true
        },
        updateVaga() {
            console.log(this.id)
            axios.put(`/api/vagas/${this.id}`, {
                habilidade_id:      this.habilidade_id, 
                local_id:           this.local_id, 
                tipo_contratacao:   this.tipo_contratacao,
                budget:             this.budget
            }).then(res => {
                this.getVagas()
                console.log(res)
            })
            .catch(err => {
                console.log(err)
            })
        },
        deleteVaga(id) {
            axios.delete(`/api/vagas/${this.id}`)
            .then(res => {
                this.getVagas()
                console.log(res)
            })
            .catch(err => {
                console.log(err)
            })
        },
        /******************Habilidade******************/
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
        },
        /*********************Local********************/
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
        },

        formatPrice(value) {
            let val = (value/1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
    },
}
</script>
