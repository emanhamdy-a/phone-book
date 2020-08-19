<template>
  <div class="modal" :class="openmodal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">
      <i class="has-text-success fa fa-check" v-bind:class="done" style="font-size:30px;" aria-hidden="true"></i>
       Add new</p>
      <button @click="close" class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
      <div class="field">
        <label class="label">Name</label>
        <div class="control">
          <input class="input" type="text" :class="{'is-danger':errors.name}" v-model="list.name" placeholder="Name">
        </div>
        <small v-if="errors.name" class="has-text-danger">{{ errors.name[0] }}</small>
        <p class="help is-danger"></p>
      </div>
      <div class="field">
        <label class="label">Phone</label>
        <div class="control">
          <input class="input" type="text" :class="{'is-danger':errors.phone}"  v-model="list.phone" placeholder="Phone">
        </div>
        <small v-if="errors.phone" class="has-text-danger">{{ errors.phone[0] }}</small>
        <p class="help is-danger"></p>
      </div>
      <div class="field">
        <label class="label">Email</label>
        <div class="control">
          <input class="input" type="text" :class="{'is-danger':errors.email}"  v-model="list.email" placeholder="Email">
        </div>
        <small v-if="errors.email" class="has-text-danger">{{ errors.email[0] }}</small>
        <p class="help is-danger"></p>
      </div>
    </section>
    <footer class="modal-card-foot">
      <button @click="save" class="button is-success">Save changes</button>
      <button class="button" @click="close">Cancel</button>
    </footer>
  </div>
</div>
</template>

<script>
export default {
  props:['openmodal'],
  data(){
    return{
      list:{
        name:'',
        email:'',
        phone:'',
      },
      errors:{},
      result:0,
      done:'is-hidden',
    }
  },
  methods:{
    close(){
      this.list={};
      this.errors={};
      this.$emit('closeRequest',0);
    },
    save(){
        axios.post("/phonebook", this.$data.list).then((response)=>{
          this.result=1;
          this.done='';
          this.errors={};
          this.$parent.lists.push(response.data)
					this.$parent.lists.sort(function(a,b){
						if (a.name > b.name) {
							return 1;
						}else if(a.name < b.name){
              return -1;
						}
					})
          setTimeout(() => {
          this.close();
          this.done='is-hidden';
          }, 1300);
        }).catch((error)=>{
          this.result=0;
          this.errors=error.response.data.errors
        });
    }
  }
}
</script>

<style>

</style>