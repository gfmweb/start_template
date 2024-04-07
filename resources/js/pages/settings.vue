<script>
import sitenav from "../components/sitenav.vue";
import sitefooter from "../components/sitefooter.vue";

export default {
    props: {user: Object, keyIndex: Number},
    emits: ["logout", 'login'],
    components: {sitenav, sitefooter},
    name: "settings",
    methods: {
        logout: function () {
            this.$emit('logout')
        },
    }
}
</script>

<template>
    <div>
        <sitenav :user="this.user" v-on:logout="logout"/>
        <section class="content">
            <p>Settings</p>
        </section>
        <sitefooter/>
    </div>
</template>

<style scoped>

</style>
