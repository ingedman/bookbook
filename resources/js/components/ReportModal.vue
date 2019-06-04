<template>
    <div>
        <!-- Modal -->
        <modal name="report"
               @before-open="beforeOpen"
               @close="closeModal"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report</h5>
                    <button type="button" class="close" @click.prevent="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>tell us what is the problem</label>
                        <textarea class="form-control" rows="3" v-model="reportContent"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" @click.prevent="closeModal">Close</button>
                    <button type="button" class="btn btn-primary" @click="report">Save report</button>
                </div>
            </div>

        </modal>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                reportContent: '',
                url: '',
            }
        },
        methods: {
            beforeOpen(event) {
                this.url = event.params.url
            },
            closeModal() {
                this.$modal.hide('report')
            },
            report() {
                axios({
                    method: 'post',
                    url: this.url,
                    data: {
                        'content': this.reportContent
                    },
                }).then((res) => {
                    if (res.data.success) {
                        this.reportContent = '';
                        this.closeModal();
                        this.$toasted.show(`Your report has been sent`, {
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
                    }
                }).catch((err) => {
                    console.log(err)
                })
            },
        },
    }
</script>
