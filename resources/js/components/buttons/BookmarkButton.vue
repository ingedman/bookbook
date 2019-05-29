<template>
    <a role="button"
       class="btn"
       :class="already?'text-secondary':''"
       data-toggle="tooltip"
       data-placement="bottom"
       title="Read later"
       @click.stop.prevent="bookmark"
    >
        <i class="far fa-bookmark line-height-initial"></i>
    </a>
</template>

<script>
    export default {
        name: 'BookmarkButton',
        props: [ 'bookmarked','url'],
        data() {
            return {
                already: this.bookmarked,
            }
        },
        methods: {
            bookmark() {
                axios({
                    method: 'get',
                    url: this.url,
                }).then((res) => {
                    this.already = res.data.already

                    this.$toasted.show(`Review is ${this.already?'added to':'removed from'} read later list`, {
                        theme: "toasted-primary",
                        position: "top-right",
                        duration : 5000,
                        action : {
                            text: 'Close',
                            onClick: (e, toastObject) => {
                                toastObject.goAway(0);
                            }
                        },
                    });
                }).catch((err) => {
                    console.log(err)
                })
            },
        },
    }
</script>
