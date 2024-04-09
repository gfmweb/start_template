<script>
import sitenav from "../components/sitenav.vue";
import sitefooter from "../components/sitefooter.vue";
import {initializeApp} from "firebase/app";
import { getMessaging, getToken } from "firebase/messaging";
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

const messaging = getMessaging();
(async () => {
    try {

        let storUser = JSON.parse(localStorage.getItem('user'))
        Notification.requestPermission().then(function(permission) {
            if (permission === 'granted') {
                getToken(messaging, { vapidKey: 'BHWxAyV9tsswoOgDkmgArYEwv8yw9JJtTMkf2b0kJt-J4570pm-mNNE3tf4ffl3N3SKxeQtaBfwvQY2HgvmQvk4' }).then((currentToken) => {
                    if (currentToken && storUser!==null) {
                       axios.post('/api/v1/FireBase',{firebase:currentToken},{headers: {Authorization: `Bearer ${storUser.Token}`}})
                           .then().catch(e=>{
                               console.log(e)
                       })
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
    props: {user: Object, keyIndex: Number},
    components: {sitenav, sitefooter},
    emits: ["logout", 'login'],
    data(){
        return{
            actions:[
                {name:'Действие 1',url:'/api/v1/action/1'},
                {name:'Действие 2',url:'/api/v1/action/2'},
                {name:'Действие 3',url:'/api/v1/action/3'}
            ]
        }
    },
    name: "lk",
    methods: {
        logout() {
            this.$emit('logout')
        },
        act(url)
        {
            axios.get(url,{headers: {Authorization: `Bearer ${this.user.Token}`}})
                .then(res=>{alert(res.data)})
                .catch(err=>{alert(err.response.data)})
        }
    }
}
</script>

<template>
    <div class="row">
        <sitenav :user="this.user" v-on:logout="logout"/>
        <section class="content">
            <section class="py-4">
                <div class="col-lg-3">
                    <div class="row justify-content-around">
                        <div class="col">
                            <button class="btn btn-outline-primary" v-for="item in actions" v-on:click="act(item.url)">{{item.name}}</button>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <sitefooter/>
    </div>
</template>

<style scoped>

</style>
