<template>
    <a role="button"
       href="#"
       @click.prevent.stop="follow"
       class="follow-btn btn  btn-sm px-2 py-0 mt-1 rounded-pill "
       :class="followed? 'btn-outline-success':'btn-success'"
    >{{followed?'unfollow':'follow'}}</a>
</template>

<script>
    import {Bus} from '../../bus'
    export default {
        name: 'FollowButton',
        props: ['url', 'already','id'],
        data() {
            return {
                followed: this.already,
            }
        },
        methods: {
            follow() {
                axios({
                    method: 'get',
                    url: this.url,
                }).then((res) => {
                    if(res.data.success){
                    Bus.$emit('userFollowed' + (this.id ? this.id : ''),  res.data.already)
                    }

                }).catch((err) => {
                    console.error(err)
                })
            },
        },
        mounted() {
            Bus.$on('userFollowed' + (this.id ? this.id : '') ,already =>{
                this.followed = already
            })
        }
    }
</script>
