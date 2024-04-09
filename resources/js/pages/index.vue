<script>
import sitenav from "../components/sitenav.vue";
import sitefooter from "../components/sitefooter.vue";

export default {
    props: {user: Object, keyIndex: Number,code:Number},
    emits: ["logout", 'login'],
    components: {sitenav, sitefooter},
    name: "index",
    methods: {
        load(){
          axios.post('/api/v1/FireBase')
        },
        logout() {
            this.$emit('logout')
        }
    }
}
</script>

<template>
    <div class="row">
        <sitenav :user="this.user" v-on:logout="logout"/>
        <section class="content">
            <button class="btn btn-outline-primary" v-on:click="load">Кнопка</button>
        </section>
        <sitefooter/>
    </div>
</template>

<style scoped>

</style>
