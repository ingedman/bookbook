<template>
    <div class="row mb-4">
        <div class="col pr-0  justify-content-start flex-grow-0 d-inline-block">
            <a class="rounded-circle no-underline" :href="url"><img class="rounded-circle" :src="photo" width="60"
                    alt="profile picture"></a>
        </div>
        <div class="col d-flex flex-column justify-content-center">
            <a class="no-underline" :href="url"><h3 class="profile-name mb-1">{{name}}</h3></a>
            <div class="">
                <follow-button :url="follow_url" :already="already" ></follow-button>
            </div>
        </div>
    </div>
</template>

<script>
    import FollowButton from './buttons/FollowButton'
    export default {
        name: 'UserProfileWidget',
        props: ['photo', 'name', 'url','follow_url', 'already'],
        components:{FollowButton},
    }
</script>
