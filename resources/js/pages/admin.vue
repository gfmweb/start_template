<script>
import sitenav from "../components/sitenav.vue";
import sitefooter from "../components/sitefooter.vue";
import roles from "../components/admin/roles.vue";
import users from "../components/admin/users.vue";
import actions from "../components/admin/actions.vue";


export default {
    props: {user: Object, keyIndex: Number},
    emits: ["logout", 'login'],
    components: {sitenav, sitefooter, roles, users,actions},
    name: "admin",
    data() {
        return {
            roles: [],
            actions:[],
            confirmAction: {},
            users: {
                data: [],
                pages: []
            }
        }
    },
    methods: {
        SuccessConfirmUsers: function (data) {
            axios.post(data.url, data.dataAction, {headers: {Authorization: `Bearer ${this.user.Token}`}})
                .then(res => {
                    this.getUsers()
                })
        },

        logout: function () {
            this.$emit('logout')
        },
        getRoles: function () {
            axios.get('/api/v1/admin/getRoles', {headers: {Authorization: `Bearer ${this.user.Token}`}})
                .then(res => {
                    this.roles = res.data
                })
        },
        getActions: function () {
            axios.get('/api/v1/admin/getActions', {headers: {Authorization: `Bearer ${this.user.Token}`}})
                .then(res => {
                    this.actions = res.data
                })
        },
        getUsers: function () {
            axios.get('/api/v1/admin/getUsersList', {headers: {Authorization: `Bearer ${this.user.Token}`}})
                .then(res => {
                    this.users = res.data
                })
        },
        addRoleToUser: function (data) {
            axios.post('/api/v1/admin/addUserRole', data, {headers: {Authorization: `Bearer ${this.user.Token}`}})
                .then(
                    this.getUsers
                )
        },
        newRoleAdd(name) {
            axios.post('/api/v1/admin/newRoleAdd', {role: name}, {headers: {Authorization: `Bearer ${this.user.Token}`}})
                .then(res => {
                    this.roles = res.data
                })
        },
        deleteRole(id) {
            axios.delete('/api/v1/admin/deleteRole?id='+id, {headers: {Authorization: `Bearer ${this.user.Token}`}})
                .then(res => {
                    this.roles = res.data
                })
        },
        confirmDeleteAction(data)
        {
            if(confirm('Вы действительно хотите удалить '+data.action)){
                axios.delete('/api/v1/admin/deleteAction?id='+data.id, {headers: {Authorization: `Bearer ${this.user.Token}`}})
                    .then(res => {
                        this.actions = res.data
                    })
            }
        },
        addAction(data)
        {
            axios.post('/api/v1/admin/addAction', data, {headers: {Authorization: `Bearer ${this.user.Token}`}})
                .then(res => {
                    this.actions = res.data
                })
        }
    },
    mounted() {
        this.getRoles()
        this.getUsers()
        this.getActions()
    }
}
</script>

<template>
    <div class="row">
        <sitenav :user="this.user" v-on:logout="logout"/>
        <section class="content">
            <div class="py-3">
                <div class="row justify-content-around">
                    <div class="col-lg-4">
                        <roles :roles="this.roles" :token="this.user.Token" v-on:newRoleAdd="newRoleAdd"
                               v-on:deleteRole="deleteRole"/>
                    </div>
                    <div class="col-lg-8">
                        <users :users="this.users" :roles="this.roles" v-on:addRole="addRoleToUser"
                               v-on:userAction="SuccessConfirmUsers"/>
                    </div>
                    <div class="col-lg-4">
                        <actions :actions="this.actions" v-on:addAction="addAction"  v-on:deleteAction="confirmDeleteAction"/>
                    </div>
                </div>
            </div>
        </section>
        <sitefooter/>
    </div>
</template>

<style scoped>

</style>
