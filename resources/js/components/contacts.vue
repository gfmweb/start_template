<script>
export default {
    props:{user: Object},
    data(){
      return {
          luser:this.user
      }
    },
    name: "contacts",
    methods:{
        cancelContact()
        {
            document.getElementById('Email').value = null
            document.getElementById('phone').value = null
            document.getElementById('telegram').value = null
            this.$emit('cancelContacts')
        },
        submit()
        {
            let email = document.getElementById('email').value
            let phone = document.getElementById('phone').value
            let telegram = document.getElementById('telegram').value
            this.$emit('submitContacts',{
                email:email,
                phone:phone,
                telegram:telegram
            })
        }
    }
}
</script>

<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Изменить контактные данные</h3>
        </div>
        <div class="card-body">
            <label class="form-label" for="email">Email</label>
            <input type="email" class="form-control mb-3" id="email" :value="this.user.Email"/>
            <label class="form-label" for="phone">Телефон</label>
            <input type="number" class="form-control mb-3" id="phone" :value="this.user.Phone"/>
            <label class="form-label" for="telegram">Телеграм id</label>
            <input type="number" class="form-control mb-3" id="telegram" :value="this.user.Telegram"/>
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-6 text-end">
                        <button class="btn btn-danger" v-on:click="cancelContact">Отменить</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-success" v-on:click="submit">Сохранить</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
