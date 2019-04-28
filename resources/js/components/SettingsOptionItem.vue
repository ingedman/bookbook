<template>
        <li class="list-group-item " >
            <div class="row">
                <div class="col"><input type="text" class="form-control" :name="`${option_name}[]`" :value="value"> </div>
                <div v-if="hideClose" class="col" ><a
                        class="p-3 text-red-light " @click="removeItem"><i class="fas fa-close"></i></a></div>
            </div>

        </li>
</template>

<script>
    export default {
        name: "SettingsOptionItem",
        props: ['option_name','iter','value', 'hideClose'],
        data() {
            return {}

        },
        methods: {
            removeItem() {
                this.$emit('remove', this.iter)
            }
        },
        computed: {
            description: {
                get() {
                    return this.item.description
                },
                set(val) {
                    const newItem = Object.assign(this.item, {description: val})
                    this.$emit('change', {index: this.iter, item: newItem})
                }


            },

        },
    }
</script>

<style scoped>

</style>
