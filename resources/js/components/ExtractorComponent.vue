<template>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Работа с экстракторами</div>
                <div class="card-body">
                    <b-button variant="primary mt-1 mb-4 offset-10" @click="creating()" v-if="!createObj">Создать новый экстрактор</b-button>
                    <table class="table table-striped"  v-show="showTable">
                        <thead>
                            <tr>
                                <th scope="col">Название</th>
                                <th>Порядковый номер</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(el, key) in extractors" v-bind:key="key" @click="edite(key)" style="cursor:pointer;">
                                <th>{{el.ename}}</th>
                                <th>{{el.inv_number}}</th>
                            </tr>
                        </tbody>
                    </table>

                    <div v-if="!showTable" class="col-md-6 offset-3">
                        <b-form  @submit.prevent="create()" offset="3" data-vv-name="form-main">
                            <b-form-group id="input-group-1" label="Название:" label-for="input-1">
                                <b-form-input id="input-1" v-model="extractor.ename" type="text" required ></b-form-input>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Порядковый номер:" label-for="input-2">
                                <b-form-input id="input-2" v-validate="{'numeric':true, 'max':11}" min="1" max="11" name="Порядковый номер" data-vv-name="Порядковый номер" v-model="extractor.inv_number" required></b-form-input>
                                <span>{{ errors.first('Порядковый номер') }}</span>
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
            extractors: null,
            extractor: {
                'ename': null,
                'inv_number': null,
            },
            extractorEmpty: {
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
            axios.get(`/api/extractor`)
            .then(resp => {
                console.log(resp.data.data);
                app.extractors = resp.data.data;

            })
        },
        edite(key){
            this.extractor = this.extractors[key];
            this.showTable = false;
        },
        onSubmit(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/extractor/${this.extractor.id}/edit/`, this.extractor)
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
            this.extractor = this.extractorEmpty;
        },
        create(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/extractor/create/`, this.extractor)
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
            axios.post(`/api/extractor/${this.extractor.id}/delete/`, this.extractor)
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
