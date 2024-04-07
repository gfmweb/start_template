<script>
import sitenav from "../components/sitenav.vue";
import sitefooter from "../components/sitefooter.vue";

export default {
    props: {user: Object, keyIndex: Number},
    components: {sitenav, sitefooter},
    emits: ["logout", 'login'],
    name: "lk",
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
            <p>Personal area</p>
        </section>
        <sitefooter/>
    </div>
</template>

<style scoped>

</style>
