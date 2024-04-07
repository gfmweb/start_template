<script>
export default {
    name: "titlechange",
    props: {title: String},
    mounted() {
        document.title = this.title
    }
}
</script>

<template>

</template>

<style scoped>

</style>
