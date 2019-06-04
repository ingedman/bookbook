<template>
    <div class="row  my-3">
        <!-- single settings option -->
        <div class="col flex-grow-1 settings-option-detail ">
            <div class="row ">
                <div class=" col-md-4 col-lg-3"><p class="h5 text-md-right">{{option.label}}</p></div>
                <div class="col-sm">
                    <div v-if="!editMode">
                        <div  v-for="(item, i) in items" :key="i" class="">{{label(item)}}</div>
                    </div>
                    <div v-else class="">
                        <form class="">

                            <ul class="list-group">
                                <li class="list-group-item d-flex align-items-center" v-for="(item,i) in items" >


                                    <v-select
                                              aria-placeholder="select a language"
                                              class="flex-grow-1"
                                              :options="option.selectOptions"
                                              :reduce="language => language.id"
                                              label="label"
                                              v-model="items[i]"
                                    ></v-select>
                                              <!--@input="items[i] = "-->

                                    <a role="button" class="btn" @click="removeItem(i)" v-show="!closeIconHidden"><i class="fas fa-times"  ></i></a>
                                </li>

                                <li class="list-group-item text-right" v-if="option.isList"><a role="button" class="btn" @click.prevent="addItem"><i class="fas fa-plus"></i></a></li>

                                <li class="list-group-item"><button type="submit" class="btn btn-primary" @click.prevent="save">Save</button></li>
                            </ul>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="col flex-grow-0 settings-option-action">
            <a @click.prevent="toggleEditMode"
               href="#"
               role="button"
               :dusk="`setting-edit-button-${option.name}`"
            ><i class="fas fa-edit"></i></a>
        </div>
        <!-- End of single settings option -->
    </div>
</template>

<script>
    import vSelect from 'vue-select'

    export default {
        props: ['option'],
        components:{vSelect},
        data() {
            return {
                items: this.option.items,
                editMode: false,
                tmpItems:[],
            }
        },
        methods:{
            toggleEditMode(){
                if (!this.editMode) {
                    /*
                     * clone the items array to a temporary array
                     * to revert back in case of cancellation
                     */
                    this.tmpItems = this.items.slice();
                }else{
                    /*
                     * revert the items array back  to a original values
                     */
                    this.items = this.tmpItems.slice()
                }
                this.editMode = !this.editMode
            },
            removeItem(index){
                if(this.items.length >1){
                    this.items.splice(index,1)
                }
            },
            addItem(){
                this.items.push('')
            },
            updateItems(event){
                this.items[event.index] = event.item;
            },
            save(){
                axios({
                    method: 'post',
                    url: window.location.href,
                    data: {
                        [this.option.name]: this.items
                    },
                }).then((res) => {
                    if (res.data.success){
                        this.tmpItems = this.items.slice()
                        this.editMode = false
                        this.$toasted.show("Your has been updated", {
                            theme: "toasted-primary",
                            position: "top-right",
                            duration : 5000,
                            action : {
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
            select(e){
                console.log(e)
                // todo: clean this
            }
        },
        computed:{
            closeIconHidden(){
              return (this.items.length < 2) || !this.option.isList
            },
            label(){
                return (id)=>{
                return this.option.selectOptions.find((item)=>{
                    return item.id == id
                }).label
                }
            }
        },

    }
</script>
