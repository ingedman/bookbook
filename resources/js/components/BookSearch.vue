<template>
        <v-select aria-placeholder="type to select a book"
                  @search="search"
                  :options="books"
                  :reduce="book => book.id"
                  label="title"
                  @input="select"
                  :value="initial_book"
        ></v-select>
</template>

<script>
    import vSelect from 'vue-select'
    export default {
        name: 'BookSearch',
        components:{vSelect},
        props: ['value','initial_book'],
        data() {
            return {
                q: '',
                books:[],
            }
        },
        methods: {
            search: _.debounce(function (search,loading) {
                // if (search.length > 2) {
                    loading(true)
                    axios({
                        method: 'get',
                        url: '/search/books',
                        params: {
                            'q': search,
                        }
                    }).then((res) => {
                        this.books = res.data
                        loading(false)
                    }).catch((err) => {
                        console.log('Error: ', err)
                    })
                // }

            }, 500),
            select(e){
                this.$emit('input',e)
            },

            searchajax(search,loading) {
                if (search.length > 2) {
                    loading(true)
                    axios({
                        method: 'get',
                        url: '/search/books',
                        params: {
                            'q': search,
                        }
                    }).then((res) => {
                        this.books = res.data
                        loading(false)

                    }).catch((err) => {
                        console.log('Error: ', err)
                    })
                }

            },
        },
        watch: {
            q() {
                this.search()
            }
        },
        mounted() {
        }
    }

</script>

<style lang="scss">
    @import "~vue-select/src/scss/vue-select.scss";
</style>

