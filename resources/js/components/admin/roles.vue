<script>
import axios from "axios";

export default {
    name: "roles",
    props: {roles: Array, token: String},
    data() {
        return {
            roleName:'',
            activeRole: {
                id: null,
                name: null
            },
            permissions: []
        }
    },
    methods: {
        openAddRoleModal() {
            this.roleName = ''
            document.getElementById('addNewRoleModal').click()
        },
        submitNewRole() {
            this.$emit('newRoleAdd', this.roleName)
            document.getElementById('closeNewRoleModal').click()
        },
        showPermissionsModal(role) {
            this.activeRole = role
            this.roleName = role.role
            axios.get('/api/v1/admin/getPermissions?role_id=' + role.id, {headers: {Authorization: `Bearer ${this.token}`}})
                .then(res => {
                    this.permissions = res.data
                })
            document.getElementById('PermissionModalBtn').click()
        },
        changeRolePermission(index) {
            if (this.permissions[index].permission == true) this.permissions[index].permission = false
            else this.permissions[index].permission = true
            axios.put('/api/v1/admin/changePermissions',
                {
                    action_id: this.permissions[index].action_id,
                    role_id: this.activeRole.id,
                    granted: this.permissions[index].permission
                }, {headers: {Authorization: `Bearer ${this.token}`}})

        }
    }
}
</script>

<template>
    <div class="container">
        <table class="table table-bordered" v-if="roles.length>0">
            <thead>
            <tr class="text-center">
                <th colspan="3">
                    Роли
                </th>
            </tr>
            <tr class="text-center">
                <th>#</th>
                <th>Роль</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(role, index) in roles">
                <td>{{ index + 1 }}</td>
                <td>{{ role.role }}</td>
                <td>
                    <button class="btn btn-success btn-sm" v-if="role.id!==2" v-on:click="showPermissionsModal(role)">
                        Редактировать
                    </button>&nbsp;
                    <button v-if="role.id!==1 && role.id!==2" class="btn btn-danger btn-sm"
                            v-on:click="this.$emit('deleteRole',role.id)">Удалить
                    </button>
                </td>
            </tr>
            </tbody>
            <tfoot class="text-center">
            <tr>
                <th colspan="3">
                    <button class="btn btn-outline-dark btn-sm" v-on:click="openAddRoleModal">Добавить</button>
                </th>
            </tr>
            </tfoot>
        </table>
        <!-- Button trigger modal -->
        <button type="button" id="addNewRoleModal" class="d-none" data-bs-toggle="modal" data-bs-target="#addRoleModal">
            Launch static backdrop modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="addRoleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавить новую роль</h1>
                        <button type="button" id="closeNewRoleModal" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="role">Роль</label>
                        <input type="text" id="role" class="form-control" v-model.trim="roleName">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                        <button type="button" class="btn btn-primary" v-on:click="submitNewRole">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->
        <button type="button" id="PermissionModalBtn" class="d-none" data-bs-toggle="modal"
                data-bs-target="#PermissionModal">
            Launch static backdrop modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="PermissionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Разрешения для роли
                            {{ this.activeRole.role }}</h1>
                        <button type="button" id="closeNewRoleModal" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Действие</th>
                                <th>Разрешение</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item,index) in permissions">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.name }}</td>
                                <td>
                                    <div class="form-check form-switch" v-on:click="changeRolePermission(index)">
                                        <input v-if="item.permission == true" class="form-check-input" type="checkbox"
                                               role="switch" id="flexSwitchCheckChecked" checked>
                                        <input v-else class="form-check-input" type="checkbox" role="switch"
                                               id="flexSwitchCheckChecked">
                                        <label v-if="item.permission == true" class="form-check-label"
                                               for="flexSwitchCheckChecked">Разрешено</label>
                                        <label v-else class="form-check-label"
                                               for="flexSwitchCheckChecked">Запрещено</label>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<style scoped>

</style>
