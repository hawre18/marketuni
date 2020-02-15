<template>
    <div>
        <!--Left Part Start -->
        <aside id="column-left" class="col-sm-3 hidden-xs">
            <h3 class="subtitle">فیلتر</h3>
            <div class="box-category">
                <div class="form-group" v-for="(attributeGroup, index) in attributeGroups">
                    <label>{{attributeGroup.title}}</label>
                    <select class="form-control" @change="addFilter($event, index)">
                        <option>انتخاب کنید...</option>
                        <option v-for="attributeValue in attributeGroup.attribute_value" :value="attributeValue.id">{{attributeValue.title}}</option>
                    </select>
                </div>
                <div class="form-group" style="text-align: left">
                    <button type="submit" class="btn btn-danger" @click="getFilterProduct()">اعمال فیلتر</button>
                </div>
            </div>
            <div class="box-category">
                <ul id="cat_accordion" v-for="category in categories" >
                    <li ><a href="#">{{category.name}}</a> <span class="down"></span>
                    </li>
                </ul>
            </div>
        </aside>
        <!--Left Part End -->
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
            <h1 class="title">{{category.name}}</h1>
            <div class="product-filter">
                <div class="row">
                    <div class="col-md-4 col-sm-5">
                        <div class="btn-group">
                            <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                            <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <label class="control-label" for="sel">مرتب سازی :</label>
                    </div>
                    <div class="col-md-3 col-sm-2 text-right">
                        <select id="sel" class="form-control" v-model="sort" @change="getSortedProduct()">
                            <option value="ASC">قیمت (کم به زیاد)</option>
                            <option value="DESC">قیمت (زیاد به کم)</option>
                        </select>
                    </div>
                    <div class="col-sm-1 text-right">
                        <label class="control-label" for="input-limit">نمایش :</label>
                    </div>
                    <div class="col-sm-2 text-right">
                        <select id="input-limit" class="form-control" v-model="paginate" @change = "getSortedProduct()">
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
            </div>
            <br />
            <div class="row products-category">
                <div class="product-layout product-grid col-lg-3 col-md-3 col-sm-4 col-xs-12" v-for="product in products.data">
                    <div class="product-thumb clearfix">
                        <div class="image"><a :href="'http://localhost:8000/products/' + product.id"><img :src=" product.photos[0].path" alt="تی شرت کتان مردانه" title="تی شرت کتان مردانه" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a :href="'http://localhost:8000/products/' + product.id">{{product.title}}</a></h4>
                            <p class="price" v-if="product.discount_price"><span class="price-new">{{product.discount_price}} تومان</span> <span class="price-old">{{product.price}} تومان</span><span class="saving">{{Math.round(Math.abs((product.price-product.discount_price)/product.price * 100))}}%</span></p>
                            <p class="price" v-if="!product.discount_price"> {{product.price}} تومان </p>
                        </div>
                        <div class="button-group">
                            <a class="btn-primary" :href="'http://localhost:8000/add-to-cart/' + product.id" ><span>افزودن به سبد</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" v-if="products.last_page">
                <div class="col-sm-12 text-center">
                    <paginate
                        v-model="page"
                        :page-count="products.last_page"
                        :page-range="3"
                        :margin-pages="2"
                        :click-handler="clickCallback"
                        :prev-text="'قبلی'"
                        :next-text="'بعدی'"
                        :container-class="'pagination'"
                        :page-class="'page-item'">
                    </paginate>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
                sort: 'DESC',
                page: 1,
                paginate: 2,
                attributeGroups: [],
                selectedAttribute: [],
                computedAttribute: [],
                flag: false,
                categories: []
            }
        },
        props: ['category'],
        mounted(){
            axios.get('/api/products/'+ this.category.id).then(res =>{
                this.products = res.data.products
            }).catch(err=>{
                console.log (err)
            })
            axios.get('/api/categories').then(res=> {
                console.log(res);
                this.cat=res.data.categories
                this.getAllChildren(res.data.categories,0);
            }).catch(err=>{
                console.log(err)
            })
            axios.get('/api/category-attribute/' + this.category.id).then(res =>{
                this.attributeGroups = res.data.attributeGroups
                console.log(res)
            }).catch(err=>{
                console.log (err)
            })
        },
        methods: {
            clickCallback: function(pageNum){
                this.products= [];
                if(this.flag){
                    this.getFilterProduct();
                }
                else if(this.sort == "ASC" || this.sort == "DESC"){
                    this.getSortedProduct()
                }else{
                    axios.get('/api/products/' + this.category.id +'?page='+ pageNum).then(res =>{
                        this.products = res.data.products
                    }).catch(err=>{
                        console.log (err)
                    })
                }
            },
            getSortedProduct: function(){
                this.products= [];
                axios.get('/api/sort-products/' + this.category.id + '/' + this.sort + '/' + this.paginate + '?page='+ this.page).then(res =>{
                    this.products = res.data.products
                }).catch(err=>{
                    console.log (err)
                })
            },
            addFilter: function(event, index){
                for(var i=0; i<this.selectedAttribute.length; i++){
                    var current = this.selectedAttribute[i];
                    if(current.index == index){
                        this.selectedAttribute.splice(i, 1)
                    }
                }
                this.selectedAttribute.push({
                    'index': index,
                    'value': event.target.value
                })
                this.computedAttribute = []
                for(var i=0; i<this.selectedAttribute.length; i++){
                    this.computedAttribute.push(this.selectedAttribute[i].value)
                }
            },
            getFilterProduct: function(){
                this.products = [];
                this.flag = true;
                var attributes = JSON.stringify(this.computedAttribute)
                axios.get('/api/filter-products/' + this.category.id + '/' + this.sort + '/' + this.paginate + '/' + attributes + '?page='+ this.page).then(res =>{
                    this.products = res.data.products
                }).catch(err=>{
                    console.log (err)
                })
            },
            getAllChildren: function (currentValue,level) {
                for (var i=0; i<currentValue.length;i++){
                    var current=currentValue[i];
                    this.categories.push({
                        id:current.id,
                        name:Array(level+1).join("----")+" "+current.name
                    })
                    if (current.children_recursive){
                        this.getAllChildren(current.children_recursive,level+1)
                    }
                }
            },
        }
    }
</script>
