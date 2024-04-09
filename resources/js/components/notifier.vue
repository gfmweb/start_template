<script>
export default {
    props:{notis:Object, modeNoti:String},
    name: "notifier",
    methods:{
        clear(){
            this.$emit('clear')
        }

    }
}
</script>

<template>
    <div :class="'alert alert-'+modeNoti+' alert-dismissible fade show'" role="alert">
        <img :src="notis.icon" class="img-fluid" style="max-width: 32px">&nbsp;
        <strong>{{notis.title}}</strong> {{notis.body}}

    </div>
</template>

<style scoped>

</style>
