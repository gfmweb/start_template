<script>
import {initializeApp} from "firebase/app";
import {getMessaging, onMessage} from "firebase/messaging";



// Initialize Firebase
const firebaseConfig = {
    apiKey: "AIzaSyAnwYFowEGblqEUStZw3SE-1nratZh-boM",
    authDomain: "nactapusher.firebaseapp.com",
    projectId: "nactapusher",
    storageBucket: "nactapusher.appspot.com",
    messagingSenderId: "499274020108",
    appId: "1:499274020108:web:8e25818792c697b72c0529"
};
const FB = initializeApp(firebaseConfig);
const messaging = getMessaging(FB);

onMessage(messaging, (payload) => {
    document.getElementById('payloadPush').innerText = JSON.stringify(payload.notification)
});


export default {
    name: "App",
    data() {
        return {
            message:{
                title:null,
                body:null
            },
            keyIndex: 0,
            user: {
                Name: null,
                Login: null,
                Auth: false,
                UserToken: null,
                RefreshToken: null,
                Phone: null,
                Email: null,
                Telegram: null,
                Roles: []
            }
        }
    },
    methods: {
        initializeUserHandle() {
            let localData = JSON.parse(localStorage.getItem('user'))
            if (localData !== null) {
                this.user = localData
                this.keyIndex++
            }
        },
        login(data) {
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
        logout() {
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

        },
        refreshUser(data) {
            this.user.Phone = data.phone
            this.user.Email = data.email
            this.user.Telegram = data.telegram
            this.keyIndex++
        },
        payload(data){
            this.message = JSON.parse(data)
        }
    },
    mounted() {
        this.initializeUserHandle()
    }
}

</script>

<template>
    <router-view v-slot="{ Component }" class="content">
        <transition name="fade">
            <component :is="Component"
                       :user="this.user"
                       :keyIndex="this.keyIndex"
                       :message="this.message"
                       v-on:refreshUser="refreshUser"
                       v-on:login="login"
                       v-on:payload="payload"
                       v-on:logout="logout"/>
        </transition>
    </router-view>
</template>

<style>
.content {
    min-height: 82vh;
}
</style>
