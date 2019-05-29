<template>
    <div class="d-flex justify-content-between">
        <div class="d-flex">
            <div class=" d-flex px-1 px-sm-2 flex-column align-items-center">
                <div>{{followers}}</div>
                <div>Followers</div>
            </div>

            <div class="d-flex px-1 px-sm-2 flex-column align-items-center">
                <div>{{following}}</div>
                <div>Following</div>
            </div>

            <div class="d-flex px-1 px-sm-2 flex-column align-items-center">
                <div>{{reviews}}</div>
                <div>Reviews</div>
            </div>
        </div>
        <div class="d-flex ">
            <share-buttons :url="user.url"></share-buttons>
            <div class="d-flex px-0 flex-column align-items-center justify-content-end">
                <div class="btn-group dropdown">
                    <a role="button"
                       class="btn focus-shadow-0 focus-outline-0"
                       id="dropdownMenuButton"
                       data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false"
                    >
                        <i class="fas fa-ellipsis-h  line-height-initial "></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" role="button" @click="openModal">Report</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ReportModal from './ReportModal'
    import ShareButtons from './buttons/ShareButtons'

    export default {
        props: ['user', 'index'],
        components: {ReportModal, ShareButtons},
        data() {
            return {
                followers: this.user.followers,
                following: this.user.following,
                reviews: this.user.reviews,
                reportContent: '',
            }
        },
        methods: {
            openModal() {
                this.$modal.show('report', {url: this.user.reportUrl})
            },
        },
        mounted() {
        }
    }
</script>

