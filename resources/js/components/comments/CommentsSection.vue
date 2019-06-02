<template>
    <div class="comments-section">
        <comment-create :url="url" @comment="addComment"></comment-create>
        <comment v-for="(comment, i) in comments" :key="i" :comment="comment"></comment>
    </div>
</template>

<script>

    import CommentCreate from './CommentCreate'
    import Comment from './Comment'
    import {Bus} from "../../bus";


    export default {
        props: ['url', 'review_comment_url', 'img_url', 'review_id'],
        components: {
            CommentCreate,
            Comment,
        },
        provide() {
            return {
                review_comment_url: this.review_comment_url,
                img_url: this.img_url
            }
        },
        data() {
            return {
                comments: [],
                urls: 'dfs'
            }
        },
        methods: {
            addComment(comment) {
                // console.log(comment)
                this.comments.unshift(comment)
            }
        },
        created() {
            // fetch comment
            axios({
                method: 'get',
                url: this.url,
            }).then((res) => {
                this.comments = res.data
            }).catch((err) => {
                console.log('Error: ', err)
            })

            // real-time update of comments
            Echo.private(`review.comments.${this.review_id}`)
                .listen('CommentEvent', (e) => {
                    console.log(!e.comment.parent)
                    if (!e.comment.parent) {
                        this.addComment(e.comment)
                    } else {
                        console.log('from section: ',`comment-${e.comment.parent}`)
                        Bus.$emit(`comment-${e.comment.parent}`, e.comment)
                    }
                });
        }
    }
</script>
