<template>
    <div class="single-comment">
        <div class="card bg-light mb-0 ">
            <div class="card-body">
                <div class="row mb-1">
                    <div class="col pr-0  justify-content-start flex-grow-0 d-inline-block">
                        <img class="rounded-circle" :src="comment.user.photo" width="40"
                             alt="picture of the comment owner">
                    </div>
                    <div class="col d-flex flex-column justify-content-center">
                        <h6 class="profile-name mb-1">{{comment.user.name}}</h6>
                        <div class="">{{comment.date}}
                        </div>
                    </div>
                </div>
                <p class="px-2">{{comment.comment}}</p>
            </div>
            <comment-controls :reply="reply" :comment="comment"
                              @click_comments="showReplies = !showReplies"></comment-controls>
        </div>
        <div class="badge badge-primary" @click="loadReplies" v-if="!reply">show replies</div>
        <div class="replies ml-5" v-show="showReplies">
            <comment
                    v-if="!reply"
                    :reply="true"
                    v-for="(comment, i) in replies"
                    :key="i"
                    :comment="comment"
                    class=" my-1"
            ></comment>
            <comment-create ref="commentCreate"
                            v-if="!reply"
                            :parent="comment.id"
                            @comment="addComment"
            ></comment-create>

        </div>

    </div>
</template>

<script>

    import CommentControls from './CommentControls'
    import Comment from './Comment'
    import CommentCreate from './CommentCreate'
    import {Bus} from "../bus";

    export default {
        name: 'Comment',
        props: [
            'comment',
            'reply'
        ],
        components: {CommentControls, Comment, CommentCreate},
        data() {
            return {
                replies: [],
                showReplies: false
            }
        },
        methods: {
            loadReplies() {

                axios({
                    method: 'get',
                    url: this.comment.replies.url,
                }).then((res) => {
                    this.replies = res.data
                    this.showReplies = true;

                    // console.log(res.data)
                    // this.commentContent = ''

                }).catch((err) => {
                    console.log('Error: ', err)
                })
            },
            addComment(comment) {
                // console.log(comment)
                this.replies.push(comment)
                // this.$forceUpdate();

            },
            scrollToCreate() {
                $('html, body').animate({
                    scrollTop: $(this.$refs.commentCreate).offset().top
                }, 2000);
            }
        },
        mounted() {
            // todo: check if the problem here was solved
            const _this = this;
            if (!this.reply) {
                console.log('comment mounted')
                Bus.$on(`comment-${this.comment.id}`, function (comment) {
                    console.log('from comment:',`comment-${_this.comment.id}`)
                    _this.addComment(comment)

                })
            }
        }
    }
</script>
