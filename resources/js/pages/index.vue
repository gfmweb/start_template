<script>
import sitenav from "../components/sitenav.vue";
import sitefooter from "../components/sitefooter.vue";

export default {
    props: {user: Object, keyIndex: Number},
    emits: ["logout", 'login'],
    components: {sitenav, sitefooter},
    name: "index",
    methods: {
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
            <p>Index</p>
        </section>
        <sitefooter/>
    </div>
</template>

<style scoped>

</style>
