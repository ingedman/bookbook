<template>
    <div class="media border-bottom border-primary py-1" v-if="!deleted">
        <img src="/images/profile_placeholder.jpg" width="30" class="mr-3 rounded-circle " alt="user profile picture">
        <a :href=" notification.data.url " class="media-body no-underline">
            <h5 class="mt-0">{{ notification.data.message }}</h5>
            <p class="mb-0">{{ notification.created_at }}</p>
        </a>
        <div class="actions d-flex justify-content-end align-self-center">
            <a href=""
               class="px-2 text-sm "
               :class="!this.isRead?'text-secondary':'text-gray'"
               @click.prevent="markAsRead"
            ><i class="fas fa-circle fa-sm"></i></a>
            <a href=""
               class="px-2 text-sm "
               :class="isConfirmed?'text-danger':'text-gray'"
               @click.prevent="deleteNotification"
               @blur="isConfirmed = false"
            ><i class="fas fa-trash "></i></a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "notificationsItem",
        props: ['notification'],
        data() {
            return {
                isRead: !!this.notification.read_at,
                isConfirmed: false,
                deleted: false,
                isLoading: false,
            }
        },
        methods: {
            markAsRead() {
                if (!this.isRead && !this.isLoading) {
                    this.isLoading = true
                    axios.get(`/notifications/read/${this.notification.id}`)
                        .then((res) => {
                            console.log(res.data)
                            if (res.data.success) {
                                this.isRead = true
                                this.isLoading = false
                            }
                        }).catch((err) => {
                        console.log('Error: ', err)
                        this.isLoading = false

                    });

                }
            },
            deleteNotification() {
                if(!this.isConfirmed){
                    this.isConfirmed =true;
                }else{
                    if (!this.isLoading) {
                        this.isLoading = true
                        axios.get(`/notifications/delete/${this.notification.id}`)
                            .then((res) => {
                                console.log(res.data)
                                if (res.data.success) {
                                    this.deleted = true
                                    this.isLoading = false
                                }
                            }).catch((err) => {
                            console.log('Error: ', err)
                            this.isLoading = false
                        });
                    }
                }
            }
        },
    }
</script>