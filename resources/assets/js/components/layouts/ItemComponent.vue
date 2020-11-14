<template>
    <div class="col-3">
        <router-link :to="{name:'product.detail', params: {id: item.id}}">
        <div v-if="item.image">
            <img class="img-list" :src="[`/storage/${path}/${item.image}`]" :alt="item.name">
        </div>
        <div v-else>
            <img class="img-list" src="/images/no-image.png" :alt="item.name">
        </div>
        <p>
            {{ item.name }}
        </p>
        </router-link>

        <addcart :product="item"></addcart>
    </div>
</template>

<script>
    import ButtonAddCartComponent from "../site/layouts/ButtonAddCartComponent";
    export default {
        props: ['item', 'path'],

        components: {
            addcart : ButtonAddCartComponent
        }
    }
</script>

<style scoped>
    .img-list{max-width: 100px;}
</style>
