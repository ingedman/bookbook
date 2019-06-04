<template>
    <div class="card my-4 bg-light">
        <div class="card-body">
            <div class="row mb-1">
                <div class="col  pr-0  justify-content-start flex-grow-0 d-inline-block">
                    <img class="rounded-circle" :src="img_url" width="40"
                         alt="picture of the user">
                </div>
                <div  class="col d-none flex-column justify-content-center" :class="isActive?'d-flex':''">
                    <h6 class="profile-name mb-1">Eslam Fakhry</h6>
                </div>
                <div class="w-100" v-show="isActive"></div>
                <div class="col">
                    <textarea class="form-control my-2 bg-transparent" :rows="isActive?'3':'1'"
                              v-model="commentContent" v-on:focus="isActive = true"></textarea>
                </div>
            </div>
            <button type="button" class="btn btn-primary" @click="comment" v-show="isActive" >Comment</button>
            <button type="button" class="btn btn-primary" @click="isActive = false" v-show="isActive" >Cancel</button>

        </div>
    </div>
</template>

<script>


    export default {
        props: ['url', 'parent'],
        inject: ['review_comment_url','img_url'],
        data() {
            return {
                commentContent: '',
                isActive: false
            }
        },
        methods: {
            comment() {

                axios({
                    method: 'post',
                    url: this.review_comment_url,
                    data: {
                        'comment': this.commentContent,
                        'parent_id': this.parent
                    }
                }).then((res) => {
                    if (res.data.success) {
                        this.commentContent = ''
                        this.isActive= false
                        this.$emit('comment',JSON.parse(res.data.comment))

                        this.$toasted.show("You comment has been posted", {
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
                    }
                }).catch((err) => {
                    console.log('Error: ', err)
                })
            }
        },
        mounted() {


        }
    }
</script>
