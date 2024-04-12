<script>
import sitenav from "../components/sitenav.vue";
import sitefooter from "../components/sitefooter.vue";
import contacts from "../components/contacts.vue";
import password from "../components/password.vue";
import axios from "axios";
export default {
    props: {user: Object, keyIndex: Number},
    emits: ["logout", 'login'],
    components: {sitenav, sitefooter, password, contacts},
    name: "settings",
    data(){
      return{
          active:null
      }
    },
    methods: {
        logout: function () {
            this.$emit('logout')
        },
        passwordSubmit: function(data)
        {
            axios.post('/api/v1/user/changePassword',data,{headers: {Authorization: `Bearer ${this.user.Token}`}})
                .then(this.active = null)
        },
        submitContacts: function (data)
        {
            axios.put('/api/v1/user/updateContacts',data,{headers: {Authorization: `Bearer ${this.user.Token}`}})
                .then(this.active = null)
            this.$emit('refreshUser',{data:data})
        }
    }
}
</script>

<template>
    <div>
        <sitenav :user="this.user" v-on:logout="logout"/>
        <section class="content py-5">
            <div class="row justify-content-around">
                <div class="col-lg-3">
                    <button class="btn btn-outline-primary rounded-3" v-on:click="active='password'">Сменить пароль</button>&nbsp;
                    <button class="btn btn-outline-secondary rounded-3" v-on:click="active='contacts'">Изменить контакты</button>
                </div>
                <div class="col-lg-8">
                    <password :user="this.user" v-if="active=='password'"
                              v-on:cancelPassword="active = null"
                              v-on:submitPassword="passwordSubmit"/>
                    <contacts :user="this.user" v-if="active=='contacts'"
                              v-on:submitContacts="submitContacts"
                              v-on:cancelContacts="active = null"/>
                </div>
            </div>
        </section>
        <sitefooter/>
    </div>
</template>

<style scoped>

</style>
