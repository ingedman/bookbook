<template>
    <div class="card my-4 bg-light">
        <div class="card-body">
            <div class="row mb-1">
                <div class="col pr-0  justify-content-start flex-grow-0 d-inline-block">
                    <img class="rounded-circle" src="http://127.0.0.1:8000/img/man.jpg" width="40"
                         alt="picture of the comment owner">
                </div>
                <div class="col d-flex flex-column justify-content-center">
                    <h6 class="profile-name mb-1">Eslam Fakhry</h6>
                </div>
            </div>
            <textarea class="form-control my-2 bg-transparent" id="exampleFormControlTextarea1" rows="3"
                      v-model="commentContent"></textarea>
            <button type="button" class="btn btn-primary" @click="comment">Comment</button>

        </div>
    </div>
</template>

<script>
    export default {
        props: ['url', 'parent'],
        data() {
            return {
                commentContent: ''
            }
        },
        methods: {
            comment() {

                axios({
                    method: 'post',
                    url: this.url,
                    data: {
                        'comment': this.commentContent,
                        'parent_id': this.parent
                    }
                }).then((res) => {
                    console.log(res.data)
                    // this.commentContent = ''

                }).catch((err) => {
                    console.log('Error: ', err)
                })
            }
        },
        mounted() {

        }
    }
</script>
