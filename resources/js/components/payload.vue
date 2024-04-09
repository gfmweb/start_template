<script>
export default {
    name: "payload",
    methods:{
        first(){
           let res = setInterval(this.myCallback, 50)
        },
         myCallback() {
            let data = document.getElementById('payloadPush').innerText
             document.getElementById('payloadPush').innerText=''
             if(data!=='') {
                 this.$emit('payload', data)
             }
        }
    },
    mounted(){
        this.first()
    }
}
</script>

<template>

</template>

<style scoped>

</style>
