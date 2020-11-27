<template>
<div>
<form @submit.prevent="postReview">

<div class="form-group">
 <label for="">Rate </label>
   <star-rating v-model="formData.rating"></star-rating>
 </div>



  <div class="form-group">
   <label for="title">Headline <small class="text-info">(optional)</small> </label>
   <input type="text" class="form-control" v-model="formData.headline" id="headline"  placeholder="Headline">
   </div>

   <div class="form-group">
     <label for="button_text">Description<small class="text-info">(Optional)</small> </label>
     <input type="text" class="form-control" v-model="formData.description" id="description">
     </div>

     <input type="hidden"  v-model="formData.user_id" value="{{$user->id }}">

       <button type="submit" class="btn btn-success">Submit</button>
     <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
</form>
<div>
</template>

<script>
export default{
   props:['user','url'],
data(){
return {
     formData:{}
}
},
methods:{
    postReview(){
    this.formData.user_id=this.user.id;
    alert('posting')
    }
}
}
</script>
