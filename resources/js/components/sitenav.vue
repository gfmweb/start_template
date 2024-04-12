<script>
export default {
    props: {user: Object},
    name: "sitenav",
    methods: {
        logout() {
            axios.get('/api/v1/logout',  {headers: {Authorization: `Bearer ${this.user.Token}`}})
                .then(res => {
                    this.$router.push('/login')
                })
            this.$emit('logout')
        },
        isAdmin() {
            let admin = false
            this.user.Roles.forEach(el => {
                if (el.role == 'Администратор') admin = true
            })
            return admin
        }
    }
}
</script>

<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
        <div class="container-fluid">
            <router-link :to="'/'" class="navbar-brand">App</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link class="nav-link" v-if="!user.Auth" :to="'/'">Главная</router-link>
                    </li>
                    <li class="nav-item" v-if="user.Auth">
                        <router-link class="nav-link" :to="'/lk'">Личный кабинет</router-link>
                    </li>
                    <li class="nav-item" v-if="!user.Auth">
                        <router-link :to="'/login'" class="nav-link">Вход</router-link>
                    </li>
                    <li class="nav-item" v-if="!user.Auth">
                        <router-link :to="'/register'" class="nav-link">Регистрация</router-link>
                    </li>
                    <li class="nav-item" v-if="isAdmin() == true">
                        <router-link :to="'/admin'" class="nav-link">Админ Панель</router-link>
                    </li>
                    <li class="nav-item dropdown d-flex" v-if="user.Auth">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{user.Name}}
                        </a>
                        <ul class="dropdown-menu" >
                            <li><router-link class="nav-link" :to="'/settings'">Настройки</router-link></li>
                            <li><hr class="dropdown-divider"></li>
                            <li ><span class="dropdown-item" role="button" v-on:click="logout">Выход</span></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>
