<template>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Работа с паспортом детали</div>
                <div class="card-body">
                    <b-button variant="primary mt-1 mb-4 offset-10" @click="creating()" v-if="!createObj">Создать паспорт детали</b-button>
                    <table class="table table-striped"  v-show="showTable">
                        <thead>
                            <tr>
                                <th scope="col">Номер характеристики</th>
                                <th scope="col">Номер детали</th>
                                <th scope="col">Значение Характеристики</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(el, key) in passports" v-bind:key="key" @click="edite(key)" style="cursor:pointer;">
                                <th>{{
                                        searchItem( el.ch_id, characts)
                                    }}</th>
                                <th>{{
                                        searchItem( el.det_id, details)
                                    }}</th>
                                <th>{{el.cvalue}}</th>
                            </tr>
                        </tbody>
                    </table>

                    <div v-if="!showTable" class="col-md-6 offset-3">
                        <b-form  @submit.prevent="create()" offset="3" data-vv-name="form-main">
                            <b-form-group id="input-group-1" label="Номер характеристики:" label-for="input-1">
                                <b-form-select v-model="passport.ch_id" :options="characts"></b-form-select>
                            </b-form-group>

                            <b-form-group id="input-group-1" label="Номер детали:" label-for="input-1">
                                <b-form-select v-model="passport.det_id" :options="details"></b-form-select>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Значение Характеристики:" label-for="input-2">
                                <b-form-input id="input-2"  name="Значение Характеристики" data-vv-name="Значение Характеристики" v-model="passport.cvalue" required></b-form-input>
                                <!-- <span>{{ errors.first('Значение Характеристики') }}</span> -->
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
            passports: null,
            passport: {
                'ch_id': null,
                'det_id': null,
                'cvalue': null,
            },
            passportEmpty: {
                'ch_id': null,
                'det_id': null,
                'cvalue': null,
            },
            characts:[],
            details:[],
        }
    },
    created() {
        this.getData();
        this.getCharcts();
        this.getDetails();
    },
    methods: {
        searchItem(needleid, haystack){

            // console.log(haystack);
            let o = haystack.find(ff => {return ff.value == needleid})
            if(typeof o !== "undefined"){
                return o.text;
            }
            else{
                return "";
            }

        },
        getCharcts(){
            let app = this;
            axios.get(`/api/charact`)
            .then(resp => {
                console.log(resp.data.data);
                // app.characts = resp.data.data;
                let itm = [];
                resp.data.data.map(function(elem){
                    itm.push({
                        text: elem.cname,
                        value: elem.id,
                    })
                });
                app.characts  = itm;
            })
        },
        getDetails(){
            let app = this;
            axios.get(`/api/detail`)
            .then(resp => {
                console.log(resp.data.data);
                // app.details = resp.data.data;

                let itm = [];
                resp.data.data.map(function(elem){
                    itm.push({
                        text: elem.name,
                        value: elem.id,
                    })
                });
                app.details  = itm;
            })
        },
        getData(){
            let app = this;
            axios.get(`/api/passport`)
            .then(resp => {
                console.log(resp.data.data);
                app.passports = resp.data.data;

            })
        },
        edite(key){
            this.passport = this.passports[key];
            this.showTable = false;
        },
        onSubmit(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/passport/${this.passport.id}/edit/`, this.passport)
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
            let empt = this.passportEmpty;
            this.passport = {};
        },
        create(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/passport/create/`, this.passport)
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
            axios.post(`/api/passport/${this.passport.id}/delete/`, this.passport)
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
