<template>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Работа с сырьем</div>
                <div class="card-body">
                    <b-button variant="primary mt-1 mb-4 offset-10" @click="creating()" v-if="!createObj">Создать новое сырье</b-button>
                    <table class="table table-striped"  v-show="showTable">
                        <thead>
                            <tr>
                                <th scope="col">Марка сырья</th>
                                <th scope="col">% содержания фуллуренов в саже</th>
                                <th scope="col">Масса, кг</th>
                                <th scope="col">Ср. значение радиуса частиц, нм</th>
                                <th scope="col">Порозность слоя, %</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(el, key) in sources" v-bind:key="key" @click="edite(key)" style="cursor:pointer;">
                                <th>{{el.name}}</th>
                                <th>{{el.percents}}</th>
                                <th>{{el.mass}}</th>
                                <th>{{el.average_radius}}</th>
                                <th>{{el.layer_porosity}}</th>
                            </tr>
                        </tbody>
                    </table>

                    <div v-if="!showTable" class="col-md-6 offset-3">
                        <b-form  @submit.prevent="create()" offset="3" data-vv-name="form-main">
                            <b-form-group id="input-group-1" label="Марка сырья:" label-for="input-1">
                                <b-form-input id="input-1" v-model="source.name" type="text" required></b-form-input>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="% содержания фуллуренов в саже:" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'decimal:8'" name="% содержания фуллуренов в саже" data-vv-name="% содержания фуллуренов в саже"
                                v-model="source.percents" required></b-form-input>
                                <span>{{ errors.first('% содержания фуллуренов в саже') }}</span>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Масса, кг:" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'decimal:8'" name="Масса" data-vv-name="Масса"
                                v-model="source.mass" required></b-form-input>
                                <span>{{ errors.first('Масса') }}</span>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Ср. значение радиуса частиц, нм:" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'decimal:8'" name="Ср. значение радиуса частиц" data-vv-name="Ср. значение радиуса частиц"
                                v-model="source.average_radius" required></b-form-input>
                                <span>{{ errors.first('Ср. значение радиуса частиц') }}</span>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Порозность слоя, %:" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'decimal:8'" name="Порозность слоя" data-vv-name="Порозность слоя"
                                v-model="source.layer_porosity" required></b-form-input>
                                <span>{{ errors.first('Порозность слоя') }}</span>
                            </b-form-group>

                            <div >
                                <b-button type="submit" class="col-3 mr-2" variant="primary" @click.prevent="onSubmit()" v-if="!createObj">Изменить</b-button>
                                <b-button type="submit" class="col-3 mr-2" variant="primary"  v-if="createObj">Создать</b-button>
                                <b-button class="col-3 mr-2" variant="warning" @click="showTable = true; createObj= false">Назад</b-button>
                                <b-button class="col-3" variant="danger" @click="deleteElem()"  v-if="!createObj">Удалить</b-button>
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
            sources: null,
            source: {
                'cname': null,
                'citem': null,
            },
            sourceEmpty: {
                'cname': null,
                'citem': null,
            },
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData(){
            let app = this;
            axios.get(`/api/source`)
            .then(resp => {
                console.log(resp.data.data);
                app.sources = resp.data.data;

            })
        },
        edite(key){
            this.source = this.sources[key];
            this.showTable = false;
        },
        onSubmit(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/source/${this.source.id}/edit/`, this.source)
                .then(resp =>{
                    console.log(resp);
                    alert("Сырье изменено!")
                },
                err => {
                    alert(err.data.msg);
                })
                .catch();
        },
        creating(){
            this.createObj = true;
            this.showTable = false;
            this.source = this.sourceEmpty;
        },
        create(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/source/create/`, this.source)
                .then(
                (resp) =>{
                    console.log(resp);
                    alert("Сырье добавленно!");
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
            axios.post(`/api/source/${this.source.id}/delete/`, this.source)
                .then(
                (resp) =>{
                    console.log(resp);
                    alert("Сырье удаленно!");
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
