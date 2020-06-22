<template>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Работа с экстрагентами</div>
                <div class="card-body">
                    <b-button variant="primary mt-1 mb-4 offset-10" @click="creating()" v-if="!createObj">Создать новый экстрагент</b-button>
                    <table class="table table-striped"  v-show="showTable">
                        <thead>
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col">Объем, л</th>
                                <th scope="col">Темепература парообразования, °C </th>
                                <th scope="col">Температура конденсации, °C</th>
                                <th scope="col">Вязкость, мПа * с</th>
                                <th scope="col">Плотность, г/см³ </th>
                                <th scope="col">Молекулярная масса пара, г/моль</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(el, key) in extragents" v-bind:key="key" @click="edite(key)" style="cursor:pointer;">
                                <th>{{el.name}}</th>
                                <th>{{el.V}}</th>
                                <th>{{el.T_vaporization}}</th>
                                <th>{{el.T_condinsasion}}</th>
                                <th>{{el.viscosity}}</th>
                                <th>{{el.density}}</th>
                                <th>{{el.molecular_mass_vap}}</th>
                            </tr>
                        </tbody>
                    </table>

                    <div v-if="!showTable" class="col-md-6 offset-3">
                        <b-form  @submit.prevent="create()" offset="3" data-vv-name="form-main">
                            <b-form-group id="input-group-1" label="Название:" label-for="input-1">
                                <b-form-input id="input-1" v-model="extragent.name" type="text" required ></b-form-input>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Объем, Л:" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'decimal:3'" name="Объем" data-vv-name="Объем" v-model="extragent.V" required></b-form-input>
                                <span>{{ errors.first('Объем') }}</span>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Температура парообразования, °C:" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'decimal:3'" name="Темепература парообразования" data-vv-name="Темепература парообразования" v-model="extragent.T_vaporization" required></b-form-input>
                                <span>{{ errors.first('Темепература парообразования') }}</span>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Температура конденсации, °C:" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'decimal:3'" name="Температура конденсации" data-vv-name="Температура конденсации" v-model="extragent.T_condinsasion" required></b-form-input>
                                <span>{{ errors.first('Температура конденсации') }}</span>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Вязкость, мПа * c:" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'decimal:3'" name="Вязкость" data-vv-name="Вязкость" v-model="extragent.viscosity" required></b-form-input>
                                <span>{{ errors.first('Вязкость') }}</span>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Плотность, г/см³ :" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'decimal:3'" name="Плотность" data-vv-name="Плотность" v-model="extragent.density" required></b-form-input>
                                <span>{{ errors.first('Плотность') }}</span>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Молекулярная масса пара, г/моль:" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'decimal:3'" name="Молекулярная масса пара" data-vv-name="Молекулярная масса пара" v-model="extragent.molecular_mass_vap" required></b-form-input>
                                <span>{{ errors.first('Молекулярная масса пара') }}</span>
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
            extragents: null,
            extragent: {
                'name': null,
                'V': null,
                'T_vaporization': null,
                'T_condinsasion': null,
                'viscosity': null,
                'density': null,
                'molecular_mass_vap': null,
            },
            extragentEmpty: {
                'name': null,
                'V': null,
                'T_vaporization': null,
                'T_condinsasion': null,
                'viscosity': null,
                'density': null,
                'molecular_mass_vap': null,
            },

            form: null,
            rus: {
                'name': 'Название',
                'V': 'Объем',
                'T_vaporization': 'Темепература парообразования',
                'T_condinsasion': 'Температура конденциации',
                'viscosity': 'Вязкость',
                'density': 'Плотность',
                'molecular_mass_vap': 'Молекулярная масса пара',
            },
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData(){
            let app = this;
            axios.get(`/api/extragent`)
            .then(resp => {
                console.log(resp.data.data);
                app.extragents = resp.data.data;

            })
        },
        edite(key){
            this.extragent = this.extragents[key];
            this.showTable = false;
        },
        onSubmit(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/extragent/${this.extragent.id}/edit/`, this.extragent)
                .then(resp =>{
                    console.log(resp);
                    alert("Экстрагент изменен!")
                },
                err => {
                    alert(err.data.msg);
                })
                .catch();
        },
        creating(){
            this.createObj = true;
            this.showTable = false;
            this.extragent = this.extragentEmpty;
        },
        create(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/extragent/create/`, this.extragent)
                .then(
                (resp) =>{
                    console.log(resp);
                    alert("Экстрагент добавлен!");
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
            axios.post(`/api/extragent/${this.extragent.id}/delete/`, this.extragent)
                .then(
                (resp) =>{
                    console.log(resp);
                    alert("Экстрагент удален!");
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
