<script>
export default {
    name: "App",
    data(){
        return {
            keyIndex:0,
            user:{
                Name:null,
                Login:null,
                Auth:false,
                UserToken:null,
                RefreshToken:null,
                Phone:null,
                Email:null,
                Telegram:null,
                Roles:[]
            }
        }
    },
    methods:{
        initializeUserHandle()
        {
            let localData = JSON.parse(localStorage.getItem('user'))
            if(
                localData.Name !== undefined &&
                localData.Login !== undefined &&
                localData.UserToken !== undefined &&
                localData.RefreshToken !== undefined
            ){
                this.user = localData
                this.keyIndex++
            }
        },
        login(data)
        {
            this.user.Name = data.name
            this.user.Login = data.login
            this.user.Token = data.token
            this.user.Email = data.email
            this.user.Auth = true
            this.user.Phone = data.phone
            this.user.Telegram = data.telegram
            this.user.Roles = data.roles
            let storeUser = JSON.stringify(this.user)
            localStorage.setItem('user', storeUser)
            this.keyIndex++

        },
        logout(){
            console.log('logout')
            this.user.Name = null
            this.user.Login = null
            this.user.Token = null
            this.user.Email = null
            this.user.Auth = false
            this.user.Phone = null
            this.user.Telegram = null
            this.user.Roles = []
            localStorage.removeItem('user')
            this.keyIndex++

        }
    },
    mounted(){
        this.initializeUserHandle()
    }
}
</script>

<template>
    <router-view v-slot="{ Component }" class="content">
        <transition name="fade">
            <component :is="Component" :user="this.user" :keyIndex="this.keyIndex" v-on:login="login" v-on:logout="logout"/>
        </transition>
    </router-view>
</template>

<style>
.content{
    min-height: 82vh;
}
</style>
