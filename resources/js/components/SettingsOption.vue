<template>
    <div class="row  my-3">
        <!-- single settings option -->
        <div class="col flex-grow-1 settings-option-detail ">
            <div class="row ">
                <div class=" col-md-3 col-lg-2"><p class="h5 text-md-right">{{label}}</p></div>
                <div class="col-sm">
                    <div v-if="!editMode">
                        <div  v-for="item in items" :key="item" class="">{{item}}</div>
                    </div>
                    <div v-else class="row">
                        <form class="col-sm-7 col-md-6">

                            <ul class="list-group">
                                <li v-for="item in items" :key="item" class="list-group-item" ><input type="text" class="form-control" name="languages[]" :value="item"></li>
                                <li class="list-group-item"><button type="submit" class="btn btn-primary">Save</button></li>
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
        props: ['label', 'initial_items_list'],
        components:{SettingsOptionItem},
        data() {
            return {
                items: this.initial_items_list,
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
                this.items.push({
                    description:'',
                    amount:1,
                    rate:0,
                })
            },
            updateItems(event){
                this.items[event.iter] = event.item;
            },
        },
        mounted() {
            console.log('Component mounted 2.')
        }
    }
</script>
