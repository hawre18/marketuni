<template>
<div>
    <div class="input-group" >
        <input type="text" placeholder="جستجو" v-model="qry" v-on:keyup="autoComplete" class="form-control input-lg" style="background-color: #ffffff;color: #000000;" />
        <div class="text-center" v-if="results.length" style="position: relative;z-index: 1000;border: 1px solid #000;background: #fff; margin-top: 22%;">
            <p v-for="result in results"  @click="productSingle(result)">{{result.title}}
            </p>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data(){
            return{
                qry:'',
                results:[],
            }
        },
        methods:{
            autoComplete(){
                this.result=[];
                //alert(this.qry);
                axios.post('/autocomplete/fetch',{
                    qry:this.qry
                })
                .then((response)=>{
                    console.log(response);
                    this.results=response.data;
                })
            },
            productSingle: function(result){
               window.location.href='/product/single/'+result.id;
            },
        }
    }
</script>
