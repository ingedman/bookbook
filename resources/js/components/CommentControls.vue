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
        <div class="col d-flex px-0 flex-column align-items-center" v-if="!reply">
            <div>{{comment.replies.count}}</div>
            <a href="#" role="button" class="btn" data-toggle="tooltip" data-placement="bottom"
               title="Comments">
                <i class="far fa-comment line-height-initial"></i>
            </a>
        </div>

        <div class="col d-flex px-0 flex-column align-items-center justify-content-end">
            <div class="btn-group dropdown">
                <a role="button" class="btn focus-shadow-0 focus-outline-0"
                   id="dropdownMenuButton"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h  line-height-initial "></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" role="button"  data-toggle="modal" :data-target="`#commentReportModal-${comment.id}`">Report</a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" :id="`commentReportModal-${comment.id}`" ref="modal"  tabindex="-1" role="dialog"
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
    // import ReportModal from './ReportModal'

    export default {
        props: ['comment', 'reply'],
        components: {},
        data() {
            return {
                likes: this.comment.likes,
                dislikes: this.comment.dislikes,
                reportContent: '',
            }
        },
        methods: {
            like() {
                axios({
                    method: 'get',
                    url: this.comment.likeUrl,
                }).then((res) => {
                    // console.log(res.data.likes)
                    this.likes = res.data.likes
                    this.dislikes = res.data.dislikes

                }).catch((err) => {
                    console.log(err)
                })

            },
            dislike() {
                axios({
                    method: 'get',
                    url: this.comment.dislikeUrl,
                }).then((res) => {
                    // console.log(res.data.dislikes)
                    this.likes = res.data.likes
                    this.dislikes = res.data.dislikes

                }).catch((err) => {
                    console.log(err)
                })
            },
            report() {
                console.log(this.comment.reportUrl)
                axios({
                    method: 'post',
                    url: this.comment.reportUrl,
                    data: {
                        'content': this.reportContent
                    },
                }).then((res) => {
                    console.log(res)
                    $(this.$refs.modal).modal('toggle')
                    this.reportContent = ''
                }).catch((err) => {
                    console.log(err)
                })
            },
        },
        mounted() {
            // console.log('Review:',this.comment)
        }
    }
</script>

<style>
    .shareDropdownMenuButton {
        min-width: auto;
        width: auto;
    }
</style>
