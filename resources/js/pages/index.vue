<script>
import sitenav from "../components/sitenav.vue";
import sitefooter from "../components/sitefooter.vue";
import payload from "../components/payload.vue";
import notifier from "../components/notifier.vue";
export default {
    props: {user: Object, keyIndex: Number,code:Number,message:Object},
    emits: ["logout", 'login','payload'],
    components: {sitenav, sitefooter,payload, notifier},
    name: "index",
    data(){
        return{
            permissions:false,
            notis:null
        }
    },
    methods: {
        getPush(){
          axios.get('/api/v1/fireBaseGetMessage',{headers: {Authorization: `Bearer ${this.user.Token}`}})
        },
        logout() {
            this.$emit('logout')
        },
        payload(data)
        {
            this.$emit('payload',data)
        }
    },
    mounted(){
        const self = this
        Notification.requestPermission().then(function(permission) {
            if (permission === 'granted') {
                self.permissions = true
            }
        })
    }
}
</script>

<template>
    <div class="row">

        <sitenav :user="this.user" v-on:logout="logout"/>
        <section class="content py-5" v-if="permissions && this.user.Auth==true">
            <payload v-on:payload="payload"/>
            <div class="container">

                <div class="row justify-content-between">
                    <div class="col" v-if="message.title!==null">
                        <notifier :mode-noti="'success'" :notis="message" v-on:clear="this.message = {title:null}"/>
                    </div>
                </div>
            </div>
            <button class="btn btn-outline-primary "  v-on:click="getPush">Получить пуш в фокусе</button>
            <p>Для получения уведомления в backgroud сверните(но не закрывайте)  браузер. Отправьте POST запрос '/api/v1/fireBaseGetMessage' c BearerToken:<br/>
            {{this.user.Token}}</p>
        </section>
        <section v-else class="content">
            <p>Для реализации FireBase Cloud messaging разрешите показ PUSH уведомлений</p>
        </section>

        <sitefooter/>
    </div>
</template>

<style scoped>

</style>
