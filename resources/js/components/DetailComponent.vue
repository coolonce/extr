<template>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Работа с деталями</div>
                <div class="card-body">
                    <b-button variant="primary mt-1 mb-4 offset-10" @click="creating()" v-if="!createObj">Создать деталь</b-button>
                    <table class="table table-striped"  v-show="showTable">
                        <thead>
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col">Тип детали</th>
                                <th scope="col">Ссылка</th>
                                <th scope="col">Шлиф</th>
                                <th scope="col">Диаметр, мм</th>
                                <th scope="col">Объем, л </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(el, key) in details" v-bind:key="key" @click="edite(key)" style="cursor:pointer;">
                                <th>{{
                                        el.name
                                    }}</th>
                                <th>{{
                                        searchItem( el.type_id, types)
                                    }}</th>
                                <th>{{el.link}}</th>
                                <th>{{el.thin_section}}</th>
                                <th>{{el.diameter}}</th>
                                <th>{{el.volume}}</th>
                            </tr>
                        </tbody>
                    </table>

                    <div v-if="!showTable" class="col-md-6 offset-3">
                        <b-form  @submit.prevent="create()" offset="3" data-vv-name="form-main">
                            <b-form-group id="input-group-2" label="Название:" label-for="input-2">
                                <b-form-input id="input-2"  name="Название" data-vv-name="Название" v-model="detail.name" required></b-form-input>
                                <!-- <span>{{ errors.first('Значение Характеристики') }}</span> -->
                            </b-form-group>

                            <b-form-group id="input-group-1" label="Тип детали:" label-for="input-1">
                                <b-form-select v-model="detail.type_id" :options="types"></b-form-select>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Ссылка:" label-for="input-2">
                                <b-form-input id="input-2"  name="Ссылка" data-vv-name="Ссылка" v-model="detail.link" required></b-form-input>
                            </b-form-group>
                            <b-form-group id="input-group-2" label="Шлиф:" label-for="input-2">
                                <b-form-input id="input-2"  name="Шлиф" data-vv-name="Шлиф" v-model="detail.thin_section" required></b-form-input>
                                <span>{{ errors.first('Шлиф') }}</span>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Диаметр, мм:" label-for="input-2">
                                <b-form-input id="input-2"  name="Диаметр"  data-vv-name="Диаметр" v-model="detail.diameter"></b-form-input>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Объем, л:" label-for="input-2">
                                <b-form-input id="input-2"  name="Объем"  data-vv-name="Объем" v-model="detail.volume"></b-form-input>
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
            details: null,
            detail: {
                'name': null,
                'type_id': null,
                'link': null,
                'thin_section': null,
                'diameter': null,
                'volume': null,
            },
            detailEmpty: {
                'ch_id': null,
                'det_id': null,
                'cvalue': null,
            },
            characts:[],
            details:[],
            types:[],
        }
    },
    created() {
        this.getData();
        // this.getCharcts();
        this.getTypes();
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
        getTypes(){
            let app = this;
            axios.get(`/api/type`)
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
                app.types  = itm;
            })
        },
        getData(){
            let app = this;
            axios.get(`/api/detail`)
            .then(resp => {
                console.log(resp.data.data);
                app.details = resp.data.data;

            })
        },
        edite(key){
            this.detail = this.details[key];
            this.showTable = false;
        },
        onSubmit(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/detail/${this.detail.id}/edit/`, this.detail)
                .then(resp =>{
                    console.log(resp);
                    alert("Деталь изменена!")
                },
                err => {
                    alert(err.data.msg);
                })
                .catch();
        },
        creating(){
            this.createObj = true;
            this.showTable = false;
            let empt = this.detailEmpty;
            this.detail = {};
        },
        create(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/detail/create/`, this.detail)
                .then(
                (resp) =>{
                    console.log(resp);
                    alert("Деталь добавлена!");
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
            axios.post(`/api/detail/${this.detail.id}/delete/`, this.detail)
                .then(
                (resp) =>{
                    console.log(resp);
                    alert("Деталь удалена!");
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
