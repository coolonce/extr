<template>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Работа с хладагентами</div>
                <div class="card-body">
                    <b-button variant="primary mt-1 mb-4 offset-10" @click="creating()" v-if="!createObj">Создать новый хладагент</b-button>
                    <table class="table table-striped"  v-show="showTable">
                        <thead>
                            <tr>
                                <th scope="col">Название хладагента</th>
                                <th scope="col">Начальная вязкость хладагента, мПа * с</th>
                                <th scope="col">Начальная плотность хладагента, г/см³</th>
                                <th scope="col">Удельная теплоемкость, Дж/(кг·К)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(el, key) in coolants" v-bind:key="key" @click="edite(key)" style="cursor:pointer;">
                                <th>{{el.name}}</th>
                                <th>{{el.start_viscosity}}</th>
                                <th>{{el.start_density}}</th>
                                <th>{{el.c}}</th>
                            </tr>
                        </tbody>
                    </table>

                    <div v-if="!showTable" class="col-md-6 offset-3">
                        <b-form  @submit.prevent="create()" offset="3" data-vv-name="form-main">
                            <b-form-group id="input-group-1" label="Название хладагента:" label-for="input-1">
                                <b-form-input id="input-1" v-model="coolant.name" type="text" required ></b-form-input>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Начальная вязкость хладагента, мПа * с:" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'decimal:3'" name="Начальная вязкость хладагента" data-vv-name="Начальная вязкость хладагента" v-model="coolant.start_viscosity" required></b-form-input>
                                <span>{{ errors.first('Начальная вязкость хладагента') }}</span>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Начальная плотность хладагента, г/см³:" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'decimal:3'" name="Начальная плотность хладагента" data-vv-name="Начальная плотность хладагента" v-model="coolant.start_density" required></b-form-input>
                                <span>{{ errors.first('Начальная плотность хладагента') }}</span>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Удельная теплоемкость, Дж/(кг·К):" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'decimal:3'" name="Удельная теплоемкость" data-vv-name="Удельная теплоемкость" v-model="coolant.c" required></b-form-input>
                                <span>{{ errors.first('Удельная теплоемкость') }}</span>
                            </b-form-group>
                            <div >
                                <b-button type="submit" class="col-3 mr-2" variant="primary" @click.prevent="onSubmit()" v-if="!createObj">Изменить</b-button>
                                <b-button type="submit" class="col-3 mr-2" variant="primary"  v-if="createObj">Создать</b-button>
                                <b-button class="col-3 mr-2" variant="warning" @click="showTable = true; createObj= false">Назад</b-button>
                                <b-button class="col-3" variant="danger" @click="deleteElem()" v-if="!createObj">Удалить</b-button>
                            </div>
                            <!-- @click.prevent="create()" -->
                        </b-form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from 'axios';
export default {

    data() {
        return {
            showTable:true,
            createObj: false,
            coolants: null,
            coolant: {
                'name': null,
                'start_viscosity': null,
                'start_density': null,
                'c': null,
            },
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData(){
            let app = this;
            axios.get(`/api/coolant`)
            .then(resp => {
                console.log(resp.data.data);
                app.coolants = resp.data.data;

            })
        },
        edite(key){
            this.coolant = this.coolants[key];
            this.showTable = false;
        },
        onSubmit(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/coolant/${this.coolant.id}/edit/`, this.coolant)
                .then(resp =>{
                    console.log(resp);
                    alert("Охладитель изменен!")
                },
                err => {
                    alert(err.data.msg);
                })
                .catch();
        },
        creating(){
            this.createObj = true;
            this.showTable = false;
            this.coolant = {};
        },
        create(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/coolant/create/`, this.coolant)
                .then(
                (resp) =>{
                    console.log(resp);
                    alert("Охладитель добавлен!");
                    this.getData();
                    this.showTable = true;
                    this.createObj = false;
                },
                (err) => {
                    alert(err.response.data.msg);
                })
                .catch(
                    err => {
                        console.log("asdas", err);
                    }
                );
        },
        deleteElem(){
            axios.post(`/api/coolant/${this.coolant.id}/delete/`, this.coolant)
                .then(
                (resp) =>{
                    console.log(resp);
                    alert("Охладитель удален!");
                    this.getData();
                    this.showTable = true;
                    this.createObj = false;
                },
                (err) => {
                    alert(err.response.data.msg);
                })
                .catch(
                    err => {
                        console.log("asdas", err);
                    }
                );
        }
    },
}
</script>

<style>

</style>
