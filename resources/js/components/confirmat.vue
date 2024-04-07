<script>
export default {
    name: "confirm",
    data() {
        return {
            confirmationText: null,
            confirmationData: {
                url: null,
                data: {}
            }
        }
    },
    methods: {
        showConfirmation(text, data) {
            this.confirmationText = text
            this.confirmationData = data
            document.getElementById('openModalConfirm').click()
        },
        ConfirmFail() {
            document.getElementById('closeConfirmModal').click()
            this.confirmationData = {
                url: null,
                dataAction: {}
            }
        },
        SuccessClose() {
            document.getElementById('closeConfirmModal').click()
            this.$emit('SuccessConfirm', this.confirmationData)
        }
    }
}
</script>

<template>
    <button type="button" id="openModalConfirm" class="d-none" data-bs-toggle="modal"
            data-bs-target="#staticConfirmation">
        Launch static backdrop modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticConfirmation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Подтверждение действия</h1>
                    <button type="button" id="closeConfirmModal" class="d-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    <button type="button" class="btn-close" v-on:click="ConfirmFail" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ confirmationText }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" v-on:click="ConfirmFail">Отменить</button>
                    <button type="button" class="btn btn-primary" v-on:click="SuccessClose">Подтвердить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
