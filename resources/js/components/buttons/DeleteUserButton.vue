<template>
    <div class="row  my-3">
        <div class="col flex-grow-1 d-flex settings-option-detail ">
                    <input class="form-control"
                           name="confirm_text"
                           required
                           v-model="confirmEmail"
                           v-show="confirmationShown"
                           placeholder="type your email to delete"
                    >
                    <div class=" col-md-3 col-lg-2">
                        <a href="#"
                           role="button"
                           class="btn btn-danger"
                           @click.prevent="deleteUser"
                        >Delete account</a>
                    </div>
            </div>
    </div>
</template>

<script>
    export default {
        name: 'DeleteUserButton',
        data() {
            return {
                confirmEmail: '',
                confirmationShown: false
            }
        },
        methods: {
            deleteUser() {
                if (!this.confirmationShown) {
                    this.confirmationShown = true
                } else {
                    this.$emit('delete_user')
                }

            },
        },
        mounted() {
        }
    }
</script>
