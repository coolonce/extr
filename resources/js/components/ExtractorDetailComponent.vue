<template>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Работа с деталями экстрактора</div>
                <div class="card-body">
                    <b-button variant="primary mt-1 mb-4 offset-10" @click="creating()" v-if="!createObj">Добавить деталь в эктрактор</b-button>
                    <table class="table table-striped"  v-show="showTable">
                        <thead>
                            <tr>
                                <th scope="col">Деталь экстрактора</th>
                                <th scope="col">Экстрактор</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(el, key) in extractorDetails" v-bind:key="key" @click="edite(key)" style="cursor:pointer;">
                                <th>{{
                                        searchItem( el.detail_id, details)
                                    }}</th>
                                <th>{{
                                        searchItem( el.extractor_id, extractors)
                                    }}</th>
                            </tr>
                        </tbody>
                    </table>

                    <div v-if="!showTable" class="col-md-6 offset-3">
                        <b-form  @submit.prevent="create()" offset="3" data-vv-name="form-main">
                            <b-form-group id="input-group-1" label="Деталь экстрактора:" label-for="input-1">
                                <b-form-select v-model="extractorDetail.extractor_id" :options="extractors"></b-form-select>
                            </b-form-group>

                            <b-form-group id="input-group-1" label="Экстрактор:" label-for="input-1">
                                <b-form-select v-model="extractorDetail.detail_id" :options="details"></b-form-select>
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
            extractorDetails: null,
            extractorDetail: {
            },
            passportEmpty: {
                'ch_id': null,
                'det_id': null,
                'cvalue': null,
            },
            extractors:[],
            details:[],
        }
    },
    created() {
        this.getData();
        this.getExtractors();
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
        getExtractors(){
            let app = this;
            axios.get(`/api/extractor`)
            .then(resp => {
                console.log(resp.data.data);
                // app.characts = resp.data.data;
                let itm = [];
                resp.data.data.map(function(elem){
                    itm.push({
                        text: elem.ename,
                        value: elem.id,
                    })
                });
                app.extractors  = itm;
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
            axios.get(`/api/extractor-details`)
            .then(resp => {
                console.log(resp.data.data);
                app.extractorDetails = resp.data.data;

            })
        },
        edite(key){
            this.extractorDetail = this.extractorDetails[key];
            this.showTable = false;
        },
        onSubmit(){
            this.$validator.validate().then(valid => {
                if (!valid) {
                    return
                }
            });
            axios.post(`/api/extractor-details/${this.extractorDetail.id}/edit/`, this.extractorDetail)
                .then(resp =>{
                    console.log(resp);
                    alert("Экстрактор изменен!")
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
            axios.post(`/api/extractor-details/create/`, this.extractorDetail)
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
            axios.post(`/api/extractor-details/${this.extractorDetail.id}/delete/`, this.extractorDetail)
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
