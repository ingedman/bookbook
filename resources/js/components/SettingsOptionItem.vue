<template>
    <li class="list-group-item d-flex align-items-center" >
        <textarea v-if="type === 'textarea'" :name="`${option_name}[]`" class="form-control" v-model="itemData"> </textarea>

        <select v-else-if="type === 'select'" :name="`${option_name}[]`" class="form-control" v-model="itemData" >
            <option v-for=" (option, key, index) in select_options"
                    :key="key"
                    :value="key"
            >{{option}}</option>

        </select>

        <input v-else type="text" class="form-control" :name="`${option_name}[]`"  v-model="itemData" >
        <a role="button" class="btn" @click="removeItem" v-show="!hideClose"><i class="fas fa-times"  ></i></a>
    </li>
</template>

<script>
    export default {
        name: "SettingsOptionItem",
        props: ['type','option_name','iter', 'hideClose','item', 'select_options'],
        data() {
            return {
            }

        },
        methods: {
            removeItem() {
                this.$emit('remove', this.iter)
            },

        },
        computed: {
            itemData: {
                get() {
                    // if (this.type === 'select') {
                    //     return this.item.id
                    // }
                    return this.item
                },
                set(val) {
                    // const newItem = Object.assign(this.item, {description: val})
                    this.$emit('change', {index: this.iter, item: val})
                }


            },

        },
        mounted() {
            if (this.type === 'select') {
                console.log('item',this.item)
            }
        }

    }
</script>

<style scoped>

</style>
