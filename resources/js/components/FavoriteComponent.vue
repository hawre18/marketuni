<template>
    <div id="appa">
        <button v-if="isFavorited" @click="unFavorite(product)">
            <i  class="fa fa-heart"></i>
        </button>
        <button v-if="!isFavorite" @click="favorite(product)">
            <i  class="fa fa-heart-o"></i>
        </button>
    </div>
</template>

<script>
    new Vue({
        el: '#appa',
        components: {
            'star-rating': VueStarRating.default
        },
        props: ['product', 'favorited'],

        data: function () {
            return {
                isFavorited: '',
            }
        },

        mounted() {
            this.isFavorited = this.isFavorite ? true : false;
        },

        computed: {
            isFavorite() {
                return this.favorited;
            },
        },

        methods: {
            favorite(product) {
                axios.post('/favorite/' + product)
                    .then(response => this.isFavorited = true)
                    .catch(response => console.log(response.data));
            },

            unFavorite(product) {
                axios.post('/unfavorite/' + product)
                    .then(response => this.isFavorited = false)
                    .catch(response => console.log(response.data));
            }
        }
    })

</script>
