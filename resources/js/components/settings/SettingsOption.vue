<template>
    <div class="row  my-3">
        <!-- single settings option -->
        <div class="col flex-grow-1 settings-option-detail ">
            <div class="row ">
                <div class=" col-md-4 col-lg-3"><p class="h5 text-md-right">{{option.label}}</p></div>
                <div class="col-sm">
                    <div v-if="!editMode">
                        <div  v-for="(item, i) in items" :key="item" class="">{{item}}</div>
                    </div>
                    <div v-else class="">
                        <form class="">

                            <ul class="list-group">
                                <settings-option-item
                                        v-for="(item, i) in items"
                                        :key="i"
                                        :iter="i"
                                        :item="item"
                                        :option_name="option.name"
                                        :type="option.type"
                                        :select_options="option.selectOptions"
                                        :hideClose="closeIconHidden"
                                        @remove="removeItem"
                                        @change="updateItems"
                                ></settings-option-item>
                                <!--<li v-for="(item, i) in items" :key="item" class="list-group-item d-flex align-items-center" >-->
                                    <!--<input type="text" class="form-control" :name="`${option.name}[]`" v-model="items[i]" >-->
                                    <!--<a role="button" class="btn" @click="removeItem(i)" v-show="!closeIconHidden"><i class="fas fa-times"></i></a>-->
                                <!--</li>-->
                                <li class="list-group-item text-right" v-if="option.isList"><a role="button" class="btn" @click.prevent="addItem"><i class="fas fa-plus"></i></a></li>

                                <li class="list-group-item"><button type="submit" class="btn btn-primary" @click.prevent="save">Save</button></li>
                            </ul>
                        </form>
                        <!--<form class="col-sm-7 col-md-6">-->
                            <!--<div v-for="item in value" :key="item"  class="form-group">-->
                                <!--<input type="text" class="form-control" name="languages[]" :value="item">-->
                            <!--</div>-->

                            <!--<button type="submit" class="btn btn-primary">Save</button>-->
                        <!--</form>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="col flex-grow-0 settings-option-action">
            <a @click.prevent="editMode = !editMode" href="#" role="button"><i class="fas fa-edit"></i></a>
        </div>
        <!-- End of single settings option -->
    </div>
</template>

<script>
    import SettingsOptionItem from './SettingsOptionItem';
    export default {
        props: ['option'],
        components:{SettingsOptionItem},
        data() {
            return {
                items: this.option.items,
                editMode: false
            }
        },
        methods:{
            removeItem(index){
                if(this.items.length >1){
                    this.items.splice(index,1)
                }
            },
            addItem(){
                if(this.option.type === 'select'){
                this.items.push({
                    id:'',
                    label:''
                })
                }else{
                this.items.push('')
                }
            },
            updateItems(event){
                this.items[event.index] = event.item;
            },
            save(){
                axios({
                    method: 'post',
                    url: window.location.href,
                    data: {
                        [this.option.name]: this.option.items.values
                    },
                }).then((res) => {
                    console.log(res.data)
                }).catch((err) => {
                    console.log(err)
                })
            }
        },
        computed:{
            closeIconHidden(){
              return (this.items.length < 2) || !this.option.isList
            },
        },
        mounted() {
            // console.log(this.option.type,this.option.items)
        }
    }
</script>
