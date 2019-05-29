<template>
    <div class="d-flex" >
        <div class=" d-flex px-0 flex-column align-items-center">
            <div>{{likes.count}}</div>
            <a role="button" class="btn" data-toggle="tooltip" data-placement="bottom"
               title="Like" @click.stop="like">
                <div :class="likes.already?'text-secondary':''"><i class="far fa-thumbs-up line-height-initial"></i>
                </div>
            </a>
        </div>
        <div class="d-flex px-0 flex-column align-items-center">
            <div>{{dislikes.count}}</div>
            <a role="button" class="btn " data-toggle="tooltip" data-placement="bottom"
               title="Dislike" @click.stop="dislike">

                <div :class="dislikes.already?'text-secondary':''"><i
                        class="far fa-thumbs-down line-height-initial"></i></div>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['model'],
        data() {
            return {
                likes: this.model.likes,
                dislikes: this.model.dislikes,
            }
        },
        methods: {
            like() {
                // instance client-side update like state until the server-side update received
                if (!this.dislikes.already) {
                    this.likes.already ? this.likes.count-- : this.likes.count++;
                } else {
                    this.dislikes.count--;
                    this.likes.count++;
                    this.dislikes.already = !this.dislikes.already;
                }
                this.likes.already = !this.likes.already;

                axios({
                    method: 'get',
                    url: this.model.likeUrl,
                }).then((res) => {
                    this.likes = res.data.likes
                    this.dislikes = res.data.dislikes

                }).catch((err) => {
                    console.log(err)
                })
            },
            dislike() {
                // instance client-side update like state until the server-side update received
                if (!this.likes.already) {
                    this.dislikes.already ? this.dislikes.count-- : this.dislikes.count++;
                } else {
                    this.likes.count--;
                    this.dislikes.count++;
                    this.likes.already = !this.likes.already;
                }
                this.dislikes.already = !this.dislikes.already;

                axios({
                    method: 'get',
                    url: this.model.dislikeUrl,
                }).then((res) => {
                    this.likes = res.data.likes
                    this.dislikes = res.data.dislikes

                }).catch((err) => {
                    console.log(err)
                })
            },

        },
    }
</script>

