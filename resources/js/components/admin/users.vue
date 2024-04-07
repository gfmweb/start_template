<script>
import confirmat from "../confirmat.vue";

export default {
    props: {users: Object, roles: Array},
    components: {confirmat},
    name: "users",
    data() {
        return {
            currentPage: 0,
            activeUserRoleAdd: {
                id: null,
                role: null
            },
            usersData: [],
            activeUser: {
                name: null,
                id: null,
                roles: []
            }
        }
    },
    methods: {
        chechAllreadyUserRole(role) {
            let result = true
            this.activeUser.roles.forEach(el => {
                if (role.id == el.id) {
                    result = false;
                }
            })
            return result;
        },
        showAddRoleModal(user) {
            this.activeUserRoleAdd = {
                id: null,
                role: null
            }
            this.activeUser = user
            document.getElementById('addUserRoleBTN').click()
        },
        addRoleToUser() {
            this.$emit('addRole', {role_id: this.activeUserRoleAdd.id, user_id: this.activeUser.id})
            document.getElementById('closeAddRoleButton').click()
        },
        SuccessConfirm(data) {
            this.$emit('userAction', data)
        },
        removeRole(user, role) {
            let text = 'Вы действительно хотите удалить роль ' + role.role + ' у пользователя ' + user.name
            this.$refs.confirm.showConfirmation(text, {
                url: '/api/v1/admin/removeUserRole',
                dataAction: {user_id: user.id, role_id: role.id}
            })
        },
        confirmResetPassword(user) {
            let text = 'Вы уверены что хотите сбросить пароль для пользователя ' + user.name
            this.$refs.confirm.showConfirmation(text, {
                url: '/api/v1/admin/dropUserPassword',
                dataAction: {id: user.id}
            })
        },
        confirmDeleteUser(user) {
            let text = 'Вы уверены что хотите удалить пользователя ' + user.name
            this.$refs.confirm.showConfirmation(text, {url: '/api/v1/admin/deleteUser', dataAction: {id: user.id}})
        }
    }
}
</script>

<template>
    <div class="container">
        <table class="table table-bordered" v-if="users.data.length > 0">
            <thead>
            <tr class="text-center">
                <th colspan="4">
                    Пользователи
                </th>
            </tr>
            <tr class="text-center">

                <th>Имя</th>
                <th>Логин</th>
                <th>Роли</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(user, index) in users.data[this.currentPage]">
                <td>{{ user.name }}</td>
                <td>{{ user.login }}</td>
                <td>
                    <span v-for="role in user.roles">
                        <br/>
                        <span class="bg-body-secondary position-relative mb-4">
                            {{ role.role }}
                            <span role="button" v-if="role.role!=='Пользователь'" class="badge text-bg-secondary"
                                  v-on:click="removeRole(user,role)">x</span>
                        </span>
                        <br/>
                    </span><br/>
                    <span role="button" class="bg-success-subtle position-relative mb-4"
                          v-on:click="showAddRoleModal(user)">
                            Добавить роль
                    </span>
                </td>
                <td class="text-center">
                    <button class="btn btn-primary btn-sm mb-2" v-on:click="confirmResetPassword(user)">Сброс пароля
                    </button>&nbsp;
                    <button class="btn btn-danger btn-sm mb-2" v-on:click="confirmDeleteUser(user)">Удалить</button>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4">
                    <div class="row justify-content-around" v-if="users.pages.length > 1" php>
                        <div class="col" v-for="page in users.pages">
                            <p>Страница {{ page + 1 }} из {{ users.pages.length }}</p>
                            <button v-if="currentPage == page" class="btn btn-sm btn-primary mt-2 mb-2 disabled">
                                {{ page + 1 }}
                            </button>
                            <button v-else class="btn btn-sm btn-outline-primary mt-2 mb-2"
                                    v-on:click="currentPage = page">{{ page + 1 }}
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
        <!-- Button trigger modal -->
        <button type="button" id="addUserRoleBTN" class="d-none" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавление роли для пользователя
                            {{ activeUser.name }}</h1>
                        <button type="button" id="closeAddRoleButton" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <div v-for="item in roles">
                                <div v-if="chechAllreadyUserRole(item)">
                                    <li role="button" v-if="item == this.activeUserRoleAdd"
                                        class="list-group-item bg-success-subtle">{{ item.role }}
                                    </li>
                                    <li role="button" v-else class="list-group-item"
                                        v-on:click="this.activeUserRoleAdd = item">{{ item.role }}
                                    </li>
                                </div>
                            </div>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                        <button type="button" class="btn btn-primary" v-on:click="addRoleToUser">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
        <confirmat ref="confirm" v-on:SuccessConfirm="SuccessConfirm"/>
    </div>

</template>

<style scoped>

</style>
