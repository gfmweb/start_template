<script>
export default {
    props:{actions:Array},
    name: "actions",
    data(){
      return {
          newAction:''
      }
    },
    methods:{
        ConfirmDeleteAction(action){
           this.$emit('deleteAction',action)
        },
        confirmNewAction()
        {
            this.$emit('addAction',{action:this.newAction})
            this.cancelNewAction()
        },
        cancelNewAction()
        {
            this.newAction = ''
            document.getElementById('cancellBtn').click()
        },


    }
}
</script>

<template>
    <div>
    <table class="table table-bordered" v-if="this.actions.length > 0">
        <thead class="text-center">
            <tr>
                <th colspan="3">Действия</th>
            </tr>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item,index) in actions">
                <td>{{index+1}}</td>
                <td>{{item.action}}</td>
                <td class="text-center">
                    <bitton class="btn btn-danger btn-sm" v-on:click="ConfirmDeleteAction(item)">Удалить</bitton>
                </td>
            </tr>
        </tbody>
        <tfoot class="text-center">
            <tr>
                <td colspan="3"><button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#newActionModal">Добавить</button> </td>
            </tr>
        </tfoot>
    </table>
        <!-- Modal -->
        <div class="modal fade" id="newActionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавить новое действие</h1>
                        <button type="button" class="btn-close" v-on:click="cancelNewAction" aria-label="Close"></button>
                        <button type="button" id="cancellBtn" class="d-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="newAction">Название действия</label>
                        <input type="text" v-model.trim="newAction" class="form-control"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" v-on:click="cancelNewAction">Отменить</button>
                        <button type="button" class="btn btn-primary" v-on:click="confirmNewAction">Создать</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
