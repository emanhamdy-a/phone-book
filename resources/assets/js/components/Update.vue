<template>
	<div class="modal" :class='openmodal'>
	  <div class="modal-background"></div>
	  <div class="modal-card">
	    <header class="modal-card-head">
	      <p class="modal-card-title">
        <i class="has-text-success fa fa-check" v-bind:class="done" style="font-size:30px;" aria-hidden="true"></i>
        Update {{ list.name }}'s Details</p>
	      <button class="delete" aria-label="close" @click='close'></button>
	    </header>
	    <section class="modal-card-body">
	      <div class="field">
	        <label class="label">Name</label>
	        <div class="control">
	          <input class="input" :class="{'is-danger':errors.name}" type="text" placeholder="Name" v-model="list.name">
	        </div>
	        <small v-if="errors.name" class="has-text-danger">{{ errors.name[0] }}</small>
	      </div>

	      <div class="field">
	        <label class="label">Phone</label>
	        <div class="control">
	          <input class="input" :class="{'is-danger':errors.phone}" type="number" placeholder="Phone" v-model="list.phone">
	        </div>
	        <small v-if="errors.phone" class="has-text-danger">{{ errors.phone[0] }}</small>
	      </div>

	      <div class="field">
	        <label class="label">Email</label>
	        <div class="control">
	          <input class="input" :class="{'is-danger':errors.email}" type="email" placeholder="Email" v-model="list.email">
	        </div>
	        <small v-if="errors.email" class="has-text-danger">{{ errors.email[0] }}</small>
	      </div>

	    </section>
	    <footer class="modal-card-foot">
	      <button class="button is-success" @click='update'>Update</button>
	      <button class="button" @click='close'>Cancel</button>
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
      },
      listnm:'',
      errors:{},
      result:0,
      done:'is-hidden',
    }
  },
  methods:{
    close(){
      this.list={};
      this.errors={};
      this.$emit('closeRequest',2);
      if(this.result==0){
        this.$parent.lists[this.listnm]=this.$parent.oldUpList;
      }
    },
    update(){
      axios.patch(`/phonebook/${this.list.id}`,this.$data.list)
      .then((response)=>{
        this.result=1;
        this.errors={};
        this.done='';
        setTimeout(() => {
          this.close();
          this.done='is-hidden';
        }, 1300);
      }).catch((error) =>{
        this.errors = error.response.data.errors
        this.result=0;
      })
    }
  }
}
</script>

<style>

</style>