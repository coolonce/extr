<template>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Работа с нагревателями</div>
                <div class="card-body">
                    <b-button variant="primary mt-1 mb-4 offset-10" @click="creating()" v-if="!createObj">Создать новый нагреватель</b-button>
                    <table class="table table-striped"  v-show="showTable">
                        <thead>
                            <tr>
                                <th scope="col">Тип нагревателя</th>
                                <th>Мощность, Вт</th>
                                <th>Полезная площадь нагрева, м^2</th>
                                <th>КПД нагревателя, %</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(el, key) in heaters" v-bind:key="key" @click="edite(key)" style="cursor:pointer;">
                                <th>{{el.type}}</th>
                                <th>{{el.power}}</th>
                                <th>{{el.effective_heating_area}}</th>
                                <th>{{el.efficiency}}</th>
                            </tr>
                        </tbody>
                    </table>

                    <div v-if="!showTable" class="col-md-6 offset-3">
                        <b-form  @submit.prevent="create()" offset="3" data-vv-name="form-main">
                            <b-form-group id="input-group-1" label="Тип нагревателя:" label-for="input-1">
                                <b-form-input id="input-1" v-model="heater.type" type="text" required ></b-form-input>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Мощность, Вт:" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'decimal:8'" min="1" max="11" name="Мощность" data-vv-name="Мощность"
                                v-model="heater.power" required></b-form-input>
                                <span>{{ errors.first('Мощность') }}</span>
                            </b-form-group>

                            <b-form-group id="input-group-1" label="Полезная площадь нагрева, м^2:" label-for="input-1">
                                <b-form-input id="input-1" v-validate="'decimal:8'" min="1" max="11" name="Полезная площадь нагрева" data-vv-name="Полезная площадь нагрева"
                                v-model="heater.effective_heating_area" required></b-form-input>
                                <span>{{ errors.first('Полезная площадь нагрева') }}</span>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="КПД нагревателя, %:" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'decimal:10'" min="1" max="11" name="КПД нагревателя" data-vv-name="КПД нагревателя"
                                v-model="heater.efficiency" required></b-form-input>
                                <span>{{ errors.first('КПД нагревателя') }}</span>
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
            heaters: null,
            heater: {
                'ename': null,
                'inv_number': null,
            },
            heaterEmpty: {
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
            axios.get(`/api/heater`)
            .then(resp => {
                console.log(resp.data.data);
                app.heaters = resp.data.data;

            })
        },
        edite(key){
            this.heater = this.heaters[key];
            this.showTable = false;
        },
        onSubmit(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/heater/${this.heater.id}/edit/`, this.heater)
                .then(resp =>{
                    console.log(resp);
                    alert("Нагреватель изменен!")
                },
                err => {
                    alert(err.data.msg);
                })
                .catch();
        },
        creating(){
            this.createObj = true;
            this.showTable = false;
            this.heater = this.heaterEmpty;
        },
        create(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/heater/create/`, this.heater)
                .then(
                (resp) =>{
                    console.log(resp);
                    alert("Нагреватель добавлен!");
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
            axios.post(`/api/heater/${this.heater.id}/delete/`, this.heater)
                .then(
                (resp) =>{
                    console.log(resp);
                    alert("Нагреватель удален!");
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
