<script>
export default {
    props:{user: Object},
    name: "password",
    data(){
        return{
            passwordModeInput:'password',
        }
    },
    methods:{
        changePasswordMode()
        {
            this.passwordModeInput = (this.passwordModeInput == 'password')?'text':'password'
        },
        cancelPasswordUpdate()
        {
            document.getElementById('current_password').value = null
            document.getElementById('new_password').value = null
            document.getElementById('password_confirmation').value = null
            this.$emit('cancelPassword')
        },
        submit()
        {
            let current_password = document.getElementById('current_password').value
            let new_password = document.getElementById('new_password').value
            let password_confirmation = document.getElementById('password_confirmation').value
            this.$emit('submitPassword',{
                current_password:current_password,
                password:new_password,
                password_confirmation:password_confirmation
            })
        }
    }
}
</script>

<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Смена пароля</h3>
        </div>
        <div class="card-body">
            <label class="form-label" for="current_password">Текущий пароль</label>
            <input :type="passwordModeInput" class="form-control mb-3" id="current_password"/>
            <label class="form-label" for="new_password">Новый пароль</label>
            <input :type="passwordModeInput" class="form-control mb-3" id="new_password"/>
            <label class="form-label" for="password_confirmation">Новый пароль еще раз</label>
            <input :type="passwordModeInput" class="form-control mb-3" id="password_confirmation"/>
            <div class="container">
                <div class="row justify-content-end">
                    <div class="form-check form-switch"  v-on:click="changePasswordMode" >
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault" >Видимость пароля</label>
                    </div>
                    <div class="col-lg-6 text-end">
                        <button class="btn btn-danger" v-on:click="cancelPasswordUpdate">Отменить</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-success" v-on:click="submit">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
