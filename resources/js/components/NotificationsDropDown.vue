<template>
    <li class="nav-item dropdown  ">
        <button class="btn nav-link focus-shadow-0" type="button" id="notificationsDropdown"
                data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell"></i><span class="hidden-md-up"> Notifications </span><span
                class="badge badge-primary badge-pill">{{notifications.length}}</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right notifications"
            aria-labelledby="notificationsDropdown">
            <div class=" d-flex justify-content-between align-items-center px-2">
                <h4 class="my-2"> Notifications</h4>
                <a href="#"
                   role="button"
                   class="btn btn-link"
                   @click.prevent="readAll"
                >read all</a>
                <a :href="all_url" class="btn btn-link">show all</a>
            </div>
            <li class="divider"></li>
            <div class="notifications-wrapper">
                <a class="content" :href="notification.url" v-for="notification in notifications">

                    <div class="notification-item d-flex align-items-center  px-2 py-3 bg-light">
                        <p class="flex-grow-1">{{notification.message}}</p>
                        <div class="btn"
                             data-toggle="tooltip"
                             data-placement="top"
                             title="mark as read"
                             @click.prevent="markRead(notification.id)"
                        >
                            <i class="fa fa-circle mr-2 fa-sm"></i>
                        </div>

                    </div>
                </a>
                <a class="content" href="#" v-if="notifications.length === 0">
                    <div class="notification-item px-2 py-3 bg-light">
                        there are no new notifications
                    </div>
                </a>
            </div>

        </ul>
    </li>
</template>

<script>
    export default {
        props: ['all_url', 'notifications_url', 'read_all_url', 'user_id'],
        data() {
            return {
                notifications: [],
            }
        },
        methods: {
            readAll() {
                axios.get(this.read_all_url)
                    .then((res) => {
                        if (res.data.success) {
                            this.notifications = []
                        }

                    }).catch((err) => {
                    console.log('Error: ', err)
                });
            },
            markRead(id) {
                axios.get(`/notifications/read/${id}`)
                    .then((res) => {
                        if (res.data.success) {
                            this.removeNotification(id)
                        }

                    }).catch((err) => {
                    console.log('Error: ', err)
                });
            },
            removeNotification(id) {
                const index = this.notifications.findIndex(notification => {
                    return notification.id === id
                })
                if (index > 0) {
                    this.notifications.splice(index, 1)
                }

            }
        },
        created() {
            axios({
                method: 'get',
                url: this.notifications_url,

            }).then((res) => {
                this.notifications = this.notifications.concat(res.data)

            }).catch((err) => {
                console.log('Error: ', err)
            });


        },
        mounted() {
            Echo.private('App.User.' + this.user_id)
                .notification((notification) => {
                    this.notifications = this.notifications.concat(notification)
                    this.$toasted.show(notification.message, {
                        theme: "toasted-primary",
                        position: "top-right",
                        duration: 5000,
                        action: {
                            text: 'Close',
                            onClick: (e, toastObject) => {
                                toastObject.goAway(0);
                            }
                        },
                    });
                });
        },
    }
</script>
