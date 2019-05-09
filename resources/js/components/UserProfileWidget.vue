<template>
    <div class="row mb-4">
        <div class="col pr-0  justify-content-start flex-grow-0 d-inline-block">
            <img class="rounded-circle" :src="photo" width="60"
                 alt="profile picture">
        </div>
        <div class="col d-flex flex-column justify-content-center">
            <h3 class="profile-name mb-1">{{name}}</h3>
            <div class="">
                <a role="button"
                   href="#"
                   @click.prevent="follow"
                   class="follow-btn btn  btn-sm px-2 py-0 mt-1 rounded-pill "
                   :class="followed? 'btn-outline-success':'btn-success'"
                >{{followed?'unfollow':'follow'}}</a>
            </div>
        </div>
    </div>
</template>

<script>
    import {Bus} from '../bus'
    export default {

        name: 'UserProfileWidget',
        props: ['photo', 'name', 'url', 'already'],
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
                    Bus.$emit('userFollowed',  res.data.already)

                }).catch((err) => {
                    console.log(err)
                })
            },
        },
        mounted() {
            Bus.$on('userFollowed',already =>{
                this.followed = already
            })
        }
    }
</script>
