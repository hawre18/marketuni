<template>
    <div>
        <div class="form-group required">
            <label for="province" class="col-sm-2 control-label">استان</label>
            <div class="col-sm-10">
                <select id="province" class="form-control" name="province" v-model="province" @change="getAllCities()">
                    <option v-for="province in provinces" :value="province.id" >{{province.name}}</option>
                </select>
            </div>
        </div>
        <div class="form-group required" v-if="cities.length>0">
            <label for="city" class="col-sm-2 control-label">شهر</label>
            <div class="col-sm-10">
                <select class="form-control" id="city" name="city">
                    <option> --- لطفا انتخاب کنید --- </option>
                    <option v-for="city in cities" :value="city.id" >{{city.name}}</option>
                </select>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                province:'استان را انتخاب کنید',
                provinces:[],
                flag:false,
                cities:[]
            }
        },
        mounted(){
            axios.get('/api/province').then(res=> {
                this.provinces=res.data.provinces
            }).catch(err=>{
                console.log(err)
            })
        },
        methods:{
            getAllCities: function () {
                axios.get('/api/cities/'+this.province).then(res=> {
                    this.cities=res.data.cities
                }).catch(err=>{
                    console.log(err)
                })
            }
        }
    }

</script>
