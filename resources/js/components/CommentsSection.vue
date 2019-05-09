<template>
    <div class="comments-section">
        <comment-create :url="url" parent="1" ></comment-create>
        <comment v-for="(comment, i) in comments" :key="i" :comment="comment"></comment>
    </div>
</template>

<script>

    import CommentCreate from './CommentCreate'
    import Comment from './Comment'

    export default {
        props: ['comments1','url'],
        components:{
            CommentCreate,
            Comment,
        },
        data(){
            return{
                comments:[]
            }
        },
        created() {
            // console.log(this.comments)
            axios({
                method: 'get',
                url: this.url,
            }).then((res) => {
                this.comments = res.data
                // console.log(res.data)
                // this.commentContent = ''

            }).catch((err) => {
                console.log('Error: ', err)
            })
        }
    }
</script>
