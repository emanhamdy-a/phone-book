<template>
<div>
  <nav class="panel column is-offset-2 is-8">
    <p class="panel-heading" style="position:relative;">
      Vue js Phonebook
      <span class="" v-if="loading">
        <i class="has-text-info fa fa-refresh fa-spin fa-1x fa-fw"></i>
      </span>
      <button @click="openAdd" class="button is-link is-outlined" style="position:absolute;top:8px;right:1px;">
        Add new
      </button>
    </p>
    <div class="panel-block">
	    <p class="control has-icons-left">
	      <input class="input is-small" type="text" placeholder="search" v-model="searchQuery">
	      <span class="icon is-small is-left">
	        <i class="fa fa-search"></i>
	      </span>
	    </p>
	  </div>
	  <a class="panel-block " v-for="item,key in temp" :key="key">
	  	<span class="column is-9">
	    	{{ item.name }}
	  	</span>
      <span class="column is-1 panel-icon" @click="Delete(key,item.id)">
        <i class="has-text-danger fa fa-trash" aria-hidden="true"></i>
      </span>
      <span class="column is-1 panel-icon" @click="openUpdate(key)">
        <i class="has-text-info fa fa-edit" aria-hidden="true"></i>
      </span>
      <span class="column is-1 panel-icon" @click="openShow(key)">
        <i class="has-text-primary fa fa-eye" aria-hidden="true"></i>
      </span>
    </a>
  </nav>
  <Add :openmodal="addActive" @closeRequest="close"></Add>
  <Show :openmodal="showActive" @closeRequest="close"></Show>
  <Update :openmodal="updateActive" @closeRequest="close"></Update>
</div>
</template>

<script>
let Add=require('./Add.vue').default;
let Show=require('./Show.vue').default;
let Update=require('./Update.vue').default;

export default {
  data(){
    return{
      addActive : '',
      showActive : '',
      updateActive : '',
      lists:{},
      updateList:{},
      errors:{},
      loading:false,
      searchQuery:'',
      temp:''
    }
  },
  components:{
    Add,
    Show,
    Update
  },
  mounted(){
    this.getData();
  },
  watch:{
    searchQuery(){
      if (this.searchQuery.length > 0) {
        // this.temp = this.lists.filter((item) => {
        //   return item.name.toLowerCase().indexOf(this.searchQuery.toLowerCase())>-1
        // });
        this.temp = this.lists.filter((item) => {
            // console.log(Object.keys(item));
            return Object.keys(item).some((key)=>{
            let string = String(item[key]) 
            // console.log(string);
            return string.toLowerCase().indexOf(this.searchQuery.toLowerCase())>-1
          })
        });
      }else{
        this.temp = this.lists
      }
    }
  },
  methods:{
    getData(){
      axios.post('/getData')
      .then((response)=> {
        this.lists = response.data 
        this.temp = response.data
      })
      .catch((error) => this.errors = error.response.data.errors)
    },
    getOne(key){
      axios.get(`/getOne/${this.lists[key].id}`)
      .then((response)=> {
        this.lists[key]=response.data;
        // this.$children[2].list=response.data;
        console.log(response);
      })
    },
    openAdd(){
      this.addActive='is-active';
    },
    openShow(key){
      this.$children[1].list=this.lists[key];
      this.showActive='is-active';
    },
    Delete(key,id){
      if(confirm('Are you shure you want to delete '+this.lists[key].name+' data.')){
        this.loading=!this.loading;
        axios.delete(`/phonebook/${id}`)
        .then((response)=>{
          this.lists.splice(key,1);
          this.loading=!this.loading;
          console.log(response);
        }).catch((error) =>{
          console.log(error);
        })
      }
    },
    openUpdate(key){
      // this.updateList=this.lists[key];
      this.$children[2].list=this.lists[key];
      this.$children[2].listnm=key;
      this.updateActive='is-active';
    },
    close(v){
      this.addActive=this.updateActive=this.showActive='';
      if(v!='undefind'){
        this.$children[v].list={};
        this.$children[v].errors={};
      }
    },
  }
}
</script>

<style>

</style>
