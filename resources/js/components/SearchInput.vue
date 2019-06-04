<template>
    <div class="search-input ml-md-4 position-relative" :class="focused?'flex-grow-1':'flex-grow-0' ">
        <div class="d-flex align-items-center  mt-2  mt-md-0 border border-primary rounded-pill">
            <i class="fas fa-search ml-3 mr-2"></i>
            <input class="form-control rounded-pill  mr-sm-2 my-0 py-1 border-0 bg-transparent focus-outline-0 focus-shadow-0"
                   name="q" type="text"
                   placeholder="Search"
                   aria-label="Search"
                   autocomplete="off"
                   v-model="searchText"
                   @focus="showResults"
                   @blur="focused = false"

            >
        </div>
        <div class="list-group position-absolute search-results w-100 mt-2 bg-white" v-if="showed">

            <div class="books-results-section border-bottom border-primary" v-if="reviews.length > 0 ">
                <h5 class="py-2 px-1 mb-0 mt-1  font-weight-bold">Reviews</h5>
                <a :href="review.url" class="list-group-item list-group-item-action" v-for="review in reviews">{{ review.text }}</a>
            </div>

            <div class="books-results-section border-bottom border-primary" v-if="books.length > 0 ">
                <h5 class="py-2 px-1 mb-0 mt-1  font-weight-bold">Books</h5>
                <a :href="book.url" class="list-group-item list-group-item-action" v-for="book in books">{{ book.text }}</a>
            </div>

            <div class="books-results-section border-bottom border-primary" v-if="users.length > 0 ">
                <h5 class="py-2 px-1 mb-0 mt-1  font-weight-bold">Users</h5>
                <a :href="user.url" class="list-group-item list-group-item-action" v-for="user in users">{{ user.text }}</a>
            </div>


            <div class="list-group-item list-group-item-action"
                 v-if="empty"
            >
                <span v-if="loading">loading...</span>
                <span v-else>no matches found.</span>
            </div>
            <a href="https://www.algolia.com/" class="list-group-item text-right py-1">
                <small class="text">search by <img class="algolia-icon"
                                                   :src="icon_url"
                                                   alt="algolia icon"
                ></small>
            </a>
        </div>
    </div>

</template>

<script>
    export default {
        name: "SearchInput",
        props:['search_url','icon_url'],
        data() {
            return {
                searchText: '',
                loading: false,
                focused: false,
                books: [],
                reviews: [],
                users: [],
            }
        },
        methods: {
            search: _.debounce(function () {
                if (this.searchText.length > 2) {
                    this.loading = true
                    axios({
                        method: 'get',
                        url: this.search_url,
                        params: {
                            'q': this.searchText,
                        }
                    }).then((res) => {
                        this.books = res.data.books || []
                        this.reviews = res.data.reviews || []
                        this.users = res.data.users || []
                        this.loading = false

                    }).catch((err) => {
                        console.log('Error: ', err)
                        this.loading = false

                    })
                }

            }, 500),

            showResults() {
                this.focused = true

            }

        },
        watch: {
            searchText() {
                this.search()
            }
        },
        computed: {
            showed() {
                this.loading = true
                return this.focused && this.searchText.length > 2;

            },
            empty(){
              return this.books.length === 0 && this.users.length === 0 && this.reviews.length === 0
            },
        },
    }
</script>

<style lang="scss" scoped>
    .search-results {
        z-index: 1000;
    }

    .algolia-icon {
        width: 58px;
    }
    .search-input{
        transition: all 1s ease;
    }

</style>