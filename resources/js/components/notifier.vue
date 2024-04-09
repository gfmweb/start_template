<script>
export default {
    props:{notis:Object, modeNoti:String},
    name: "notifier"
}
</script>

<template>
    <div :class="'alert alert-'+modeNoti+' alert-dismissible fade show'" role="alert">
        <strong>{{notis.title}}</strong> {{notis.body}}
        <button type="button" class="d-none" data-bs-dismiss="alert" aria-label="Close"></button>
        <button type="button" class="btn-close"  aria-label="Close"></button>
    </div>
</template>

<style scoped>

</style>
