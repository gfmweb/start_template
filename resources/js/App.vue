<script>
import {initializeApp} from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";
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
//

const messaging = getMessaging();
onMessage(messaging, (payload) => {
    console.log('А вот мы получили пуш когда страница в фокусе '+payload.notification.body)
    localStorage.setItem('Message', JSON.stringify(payload.notification));
});
(async () => {
    try {
        Notification.requestPermission().then(function(permission) {
            if (permission === 'granted') {
                getToken(messaging, { vapidKey: 'BHWxAyV9tsswoOgDkmgArYEwv8yw9JJtTMkf2b0kJt-J4570pm-mNNE3tf4ffl3N3SKxeQtaBfwvQY2HgvmQvk4' }).then((currentToken) => {
                    if (currentToken) {
                        localStorage.setItem('firebase',currentToken)
                    } else {
                        console.log('Нет активного разрешения необходимо перезапросить');
                    }
                }).catch((err) => {
                    console.log(err)
                });
            }
        });
    } catch (error) {
        console.log(error)
    }
})();


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
                localData !== null
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
        refreshUser(data)
        {
            this.user.Phone = data.phone
            this.user.Email = data.email
            this.user.Telegram = data.telegram
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
            <component :is="Component"
                       :user="this.user"
                       :keyIndex="this.keyIndex"
                       v-on:refreshUser="refreshUser"
                       v-on:login="login"
                       v-on:logout="logout"/>
        </transition>
    </router-view>
</template>

<style>
.content{
    min-height: 82vh;
}
</style>
