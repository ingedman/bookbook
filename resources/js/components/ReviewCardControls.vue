<template>
    <div class="row">
        <div class="col d-flex px-0 flex-column align-items-center">
            <div>{{likes.count}}</div>
            <a role="button" class="btn" data-toggle="tooltip" data-placement="bottom"
               title="Like" @click="like">
                <div :class="likes.already?'text-secondary':''"><i class="far fa-thumbs-up line-height-initial"></i>
                </div>
            </a>
        </div>
        <div class="col d-flex px-0 flex-column align-items-center">
            <div>{{dislikes.count}}</div>
            <a role="button" class="btn " data-toggle="tooltip" data-placement="bottom"
               title="Dislike" @click="dislike">

                <div :class="dislikes.already?'text-secondary':''"><i
                        class="far fa-thumbs-down line-height-initial"></i></div>
            </a>
        </div>
        <div class="col d-flex px-0 flex-column align-items-center">
            <div>{{review.comments.count}}</div>
            <a :href="review.comments_url" role class="btn" data-toggle="tooltip" data-placement="bottom"
               title="Comments">
                <i class="far fa-comment line-height-initial"></i>
            </a>
        </div>
        <div class="col d-flex px-0 flex-column align-items-center justify-content-end hidden-sm-down">

            <div class="dropdown">
                <a class="btn" role="button" id="shareDropdownMenuButton" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-share-alt line-height-initial"></i>
                </a>
                <div class="dropdown-menu shareDropdownMenuButton " aria-labelledby="shareDropdownMenuButton">

                    <a class="dropdown-item" target="blank"
                       :href="`https://www.facebook.com/sharer/sharer.php?u=${review.url}`"> <i
                            class="fab fa-facebook-f line-height-initial"></i></a>
                    <a class="dropdown-item" target="blank"
                       :href="`https://twitter.com/intent/tweet?url=${review.url}`"> <i
                            class="fab fa-twitter line-height-initial"></i></a>
                </div>
            </div>
        </div>
        <div class="col d-flex px-0 flex-column align-items-center justify-content-end hidden-md-down">
            <a role="button" class="btn" data-toggle="tooltip" data-placement="bottom"
               title="Read later">
                <i class="far fa-bookmark line-height-initial"></i>
            </a>
        </div>
        <div class="col d-flex px-0 flex-column align-items-center justify-content-end">
            <div class="btn-group dropdown">
                <a role="button" class="btn focus-shadow-0 focus-outline-0"
                   id="dropdownMenuButton"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h  line-height-initial "></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right"
                     aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item hidden-md-up" target="blank"
                       :href="`https://www.facebook.com/sharer/sharer.php?u=${review.url}`"><i
                            class="fab fa-facebook-f line-height-initial"></i> <span class="ml-2">facebook</span></a>
                    <a class="dropdown-item hidden-md-up" target="blank"
                       :href="`https://twitter.com/intent/tweet?url=${review.url}`"><i
                            class="fab fa-twitter line-height-initial"></i> <span class="ml-2">twitter</span></a>
                    <div class="dropdown-divider hidden-md-up"></div>
                    <a class="dropdown-item hidden-lg-up" href="#"><i
                            class="far fa-bookmark line-height-initial"></i><span class="ml-2">Read later</span></a>
                    <a class="dropdown-item" role="button"  data-toggle="modal" :data-target="`#reviewReportModal-${index}`">Report</a>
                    <!--<a class="dropdown-item" role="button" @click="report">Report</a>-->
                    <!--<report-modal></report-modal>-->
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" :id="`reviewReportModal-${index}`" ref="modal"  tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label >tell us what is the problem</label>
                            <textarea class="form-control"  rows="3" v-model="reportContent"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="report">Save report</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    import ReportModal from './ReportModal'

    //TODO: add bookmark functionality

    export default {
        props: ['review','index'],
        components: {ReportModal},
        data() {
            return {
                likes: this.review.likes,
                dislikes: this.review.dislikes,
                reportContent: '',
            }
        },
        methods: {
            like() {
                axios({
                    method: 'get',
                    url: `${this.review.url}/like`,
                }).then((res) => {
                    console.log(res.data.likes)
                    this.likes = res.data.likes
                    this.dislikes = res.data.dislikes

                }).catch((err) => {
                    console.log(err)
                })

            },
            dislike() {
                axios({
                    method: 'get',
                    url: `${this.review.url}/dislike`,
                }).then((res) => {
                    console.log(res.data.dislikes)
                    this.likes = res.data.likes
                    this.dislikes = res.data.dislikes

                }).catch((err) => {
                    console.log(err)
                })
            },
            report() {
                axios({
                    method: 'post',
                    url: this.review.reportUrl,
                    data: {
                        'content': this.reportContent
                    },
                }).then((res) => {
                    $(this.$refs.modal).modal('toggle')
                    this.reportContent = ''
                }).catch((err) => {
                    console.log(err)
                })
            },
        },
        mounted() {
            console.log('Review:',this.review)
        }
    }
</script>

<style>
    .shareDropdownMenuButton {
        min-width: auto;
        width: auto;
    }
</style>
