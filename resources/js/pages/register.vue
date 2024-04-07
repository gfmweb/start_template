<script>
import sitenav from "../components/sitenav.vue";
import sitefooter from "../components/sitefooter.vue";

export default {
    props: {user: Object, keyIndex: Number},
    components: {sitenav, sitefooter},
    emits: ["logout", 'login'],
    name: "register",
    data() {
        return {
            login: '',
            password: '',
            password_confirmation: '',
            name: '',
            passwordMode: 'password'
        }
    },
    methods: {
        changePasswordMode() {
            this.passwordMode = (this.passwordMode == 'password') ? 'text' : 'password'
        },
        submitRegister() {
            axios.post('/api/v1/register', {
                name: this.name,
                login: this.login,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
                .then(res => {
                    this.$emit('login', res.data)
                    this.$router.push('/lk')
                })
        }
    }
}
</script>

<template>
    <div class="row">
        <sitenav :user="this.user"/>
        <section class="content">
            <div class="py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="card shadow-sm">
                            <form v-on:submit.prevent="submitRegister">
                                <div class="card-header">
                                    <h4 class="card-title">Регистрация</h4>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <label for="login">Имя</label>
                                        <input v-model.trim="name" type="text" class="form-control mb-3" id="login">
                                        <label for="login">Логин</label>
                                        <input v-model.trim="login" type="text" class="form-control mb-3" id="login">
                                        <label for="password">Пароль</label>
                                        <div class="input-group mb-3">
                                            <input :type="passwordMode" v-model.trim="password" class="form-control"
                                                   id="password" aria-describedby="basic-addon1">
                                            <span v-on:click="changePasswordMode" class="input-group-text small"
                                                  id="basic-addon1" role="button">
                                   <svg v-if="passwordMode=='text'" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                    <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7 7 0 0 0 2.79-.588M5.21 3.088A7 7 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474z"/>
                                        <path
                                            d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z"/>
                                    </svg>
                                </span>
                                        </div>
                                        <label for="password">Пароль еще раз</label>
                                        <div class="input-group mb-3">
                                            <input :type="passwordMode" v-model.trim="password_confirmation"
                                                   class="form-control" id="password" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn  rounded-3 btn-success" type="submit">
                                        Зарегистрироваться
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <sitefooter/>
    </div>
</template>

<style scoped>

</style>
