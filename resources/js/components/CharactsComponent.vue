<template>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Работа с характеристиками</div>
                <div class="card-body">
                    <b-button variant="primary mt-1 mb-4 offset-10" @click="creating()" v-if="!createObj">Создать новую характеристику</b-button>
                    <table class="table table-striped"  v-show="showTable">
                        <thead>
                            <tr>
                                <th scope="col">Название характеристики</th>
                                <th scope="col">Номер детали</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(el, key) in characts" v-bind:key="key" @click="edite(key)" style="cursor:pointer;">
                                <th>{{el.cname}}</th>
                                <th>{{el.citem}}</th>
                            </tr>
                        </tbody>
                    </table>

                    <div v-if="!showTable" class="col-md-6 offset-3">
                        <b-form  @submit.prevent="create()" offset="3" data-vv-name="form-main">
                            <b-form-group id="input-group-1" label="Название характеристики:" label-for="input-1">
                                <b-form-input id="input-1" v-model="charact.cname" type="text" required></b-form-input>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Номер детали:" label-for="input-2">
                                <b-form-input id="input-2" v-validate="'digit:10'" name="Номер детали" data-vv-name="Номер детали" v-model="charact.citem" required></b-form-input>
                                <span>{{ errors.first('Номер детали') }}</span>
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
            characts: null,
            charact: {
                'cname': null,
                'citem': null,
            },
            charactEmpty: {
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
            axios.get(`/api/charact`)
            .then(resp => {
                console.log(resp.data.data);
                app.characts = resp.data.data;

            })
        },
        edite(key){
            this.charact = this.characts[key];
            this.showTable = false;
        },
        onSubmit(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/charact/${this.charact.id}/edit/`, this.charact)
                .then(resp =>{
                    console.log(resp);
                    alert("Характеристика изменена!")
                },
                err => {
                    alert(err.data.msg);
                })
                .catch();
        },
        creating(){
            this.createObj = true;
            this.showTable = false;
            this.charact = this.charactEmpty;
        },
        create(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/charact/create/`, this.charact)
                .then(
                (resp) =>{
                    console.log(resp);
                    alert("Характеристика добавлена!");
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
            axios.post(`/api/charact/${this.charact.id}/delete/`, this.charact)
                .then(
                (resp) =>{
                    console.log(resp);
                    alert("Характеристика удалена!");
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
