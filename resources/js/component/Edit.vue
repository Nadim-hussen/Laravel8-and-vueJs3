<template>
<div>
  <div class="d-flex justify-content-center mt-3">
      <router-link to="/profile" class="btn btn-dark p-2">Back Profile</router-link>
    </div>
    <!-- <div class="d-flex justify-content-center align-items-center gap-2">

<div>
   <p><span>Title :  {{ arr.title}} </span> </p>
   <p><span>Description :  {{ arr.description}}</span> </p>
   <p><span>Category :  {{ arr.category}}</span> </p>

            </div>
            </div> -->
<div class="home-head">
   <div class="home-bottom">
<form>
        <div class="form-title">
            <label for="title">Title &nbsp; : &nbsp;</label>
            <input type="text" v-model="arr.title"  id="title" placeholder="Title" /> <br/>
        </div>
        <div class="form-category">
            <label for="category">Category &nbsp; : &nbsp;</label>
            <input type="text" v-model="arr.category"   id="category" placeholder="Category" /> <br/>
        </div>
        <!-- <div class="form-img">
            <label for="img">Image &nbsp; : &nbsp;</label>
            <input type="file"  @change="previewFiles" multiple /> <br />
            <input type="hidden" name="old_image" >
        </div> -->
        <div class="form-img">
            <input type="file" @change="onChange" />
        </div>
        <div class="form-description">

            <textarea type="text" v-model="arr.description" id="desc" cols="40" rows="15" placeholder="Enter The description of your Post">

            </textarea>
        </div>
         <input type="hidden" v-model="arr.id">
        <button type="submit" @click.prevent="updateUser" class="form-btn btn btn-primary">Update</button>
    </form>
     </div>
     </div>
     </div>
</template>
<script>
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import { useCookies } from "vue3-cookies";
import { useRoute } from "vue-router";
export default {
    setup() {
        const router = useRouter();
    const { cookies } = useCookies();
    let file = ref('')
    const route = useRoute();
    let arr = ref([])
        onMounted(() => {
      if (cookies.get("email")) {
          singleUser()
      } else {
        router.push({
          name: "Login",
        });
      }
    });
    const singleUser = async () => {
     let response = await axios.get(`/api/singleUser/${route.params.id}`)
        arr.value = response.data;
    };
     const onChange = (e)=>{
            file.value = e.target.files[0];
        }
    const updateUser = async (e) =>{
        e.preventDefault();
        const config ={
                headers:{
                    'content-type' : 'multipart/form-data'
                }
            }
            let data = new FormData();

      if(file.value !=''){
          data.append('id',arr.value.id)
             data.append('title',arr.value.title)
             data.append('category',arr.value.category)
             data.append('email',arr.value.email)
             data.append('photo',file.value)
             data.append('description',arr.value.description)
         await axios.post(`/api/updateUser`,data,config).then(()=>{
            router.push({name:"Profile"})
        })
      }else{
          data.append('id',arr.value.id)
             data.append('title',arr.value.title)
             data.append('category',arr.value.category)
             data.append('email',arr.value.email)
             data.append('photo',arr.value.photo)
             data.append('description',arr.value.description)
        await axios.post(`/api/updateUser`,data,config).then(()=>{
            router.push({name:"Profile"})
        })
      }



    }

    return{
        singleUser,
        arr,
        updateUser,
        onChange,
        file

    }

    }
}
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');





*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.head-h2{
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
}
h2{
    font-family: 'Roboto', sans-serif;
    margin-top: 20px;
    color: #0771de;
    font-weight: bold;
    font-size: 1.5rem;
    text-align: center;
    text-shadow: 2px 1px #0771de;
}

.home-bottom{
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    margin-top: 30px;
}
form{
    display: flex;
    flex-direction: column;
    justify-content: center;
    font-family: 'Roboto', sans-serif;
}
.form-title{
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-bottom: 15px;
}
.form-title input{
    width: 65%;
    padding: 5px;
}
.form-title label{
    margin-right: 10px;
    font-weight: bold;
}

.form-category{
    margin-bottom: 10px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
.form-category input{
    width: 65%;
    padding: 5px;
}
.form-category label{
    margin-right: 10px;
    font-weight: bold;
}
.form-img{
    margin-bottom: 10px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
.form-img input{
    width: 65%;
    padding: 5px;
}
.form-img label{
    margin-right: 10px;
    font-weight: bold;
}
.form-description{
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
.form-description label{
    top: 0;
}
.form-description textarea{
 resize: none;
 font-size: 1rem;
}
.form-btn{
    padding: 4px;
    margin: 10px auto;
    font-size: 15px;
    font-family: 'Roboto', sans-serif;
    font-weight: bold;
}
input{
    border: 1px solid black;
}
textarea{
    border: 1px solid black;
}
</style>