<template>
    <div class="row  my-3">
        <!-- single settings option -->
        <div class="col flex-grow-1 settings-option-detail ">
            <div class="row ">
                <div class=" col-md-4 col-lg-3"><p class="h5 text-md-right">{{option.label}}</p></div>
                <div class="col-sm">
                    <div v-if="!editMode">
                        <div class="">{{item}}</div>
                    </div>
                    <div v-else class="">
                        <input :type="option.type" class="form-control" :name="option.name" v-model="item">
                        <button type="submit" class="btn btn-primary" @click.prevent="save">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col flex-grow-0 settings-option-action">
            <a @click.prevent="toggleEditMode"
               href="#"
               role="button"
               :dusk="`setting-edit-button-${option.name}`"
            ><i class="fas fa-edit"></i></a>
        </div>
        <!-- End of single settings option -->
    </div>
</template>

<script>
    export default {
        name: 'TextOption',
        props: ['option'],
        data() {
            return {
                item: this.option.item,
                tmpItem: '',
                editMode: false
            }
        },
        methods: {
            toggleEditMode() {
                if (!this.editMode) {
                    /*
                     * clone the item value to a temporary variable
                     * to revert back in case of cancellation
                     */
                    this.tmpItem = this.item;
                } else {
                    /*
                     * revert the item value back  to a original value
                     */
                    this.item = this.tmpItem
                }
                this.editMode = !this.editMode
            },
            save() {
                axios({
                    method: 'post',
                    url: window.location.href,
                    data: {
                        [this.option.name]: this.item
                    },
                }).then((res) => {
                    if (res.data.success) {
                        this.tmpItem = this.item
                        this.editMode = false

                        this.$toasted.show("Your has been updated", {
                            theme: "toasted-primary",
                            position: "top-right",
                            duration: 5000,
                            action: {
                                text: 'Close',
                                onClick: (e, toastObject) => {
                                    toastObject.goAway(0);
                                }
                            },
                        });
                    }
                }).catch((err) => {
                    console.log(err)
                })
            }
        },

    }
</script>
