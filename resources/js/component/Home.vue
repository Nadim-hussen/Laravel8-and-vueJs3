<template>
<div class="navbar">
        <span class="left">
                <router-link class="router-reg" to="/home" exact>Home</router-link>
        <router-link class="router-log" to="/profile" exact> Profile</router-link>
        </span>

    </div>
  <div>
    <form>
    <div class="input-group mb-2 w-50 mx-auto">

      <input type="search"  v-model="category" class="form-control rounded " placeholder="Search By Category" aria-label="Search" aria-describedby="search-addon" />
      <button type="submit" @click.prevent="search" class="btn btn-outline-primary">search</button>

    </div>
    </form>
    <table class="table table-stripedd-flex justify-content-center">
    <thead class="text-center">
    <tr>
      <th scope="col">id</th>
      <th scope="col">Title</th>
      <th scope="col">Category</th>
      <th scope="col">Details</th>

    </tr>
  </thead>
  <template v-if="arr.length>0 && item">

             <template v-for="item in arr" :key="item.id">

       <tbody class="text-center">
     <tr>
      <td>{{item.id}}</td>
      <td>{{item.title}}</td>
      <td>{{item.category}}</td>
      <!-- <button class="btn btn-dark" @click="details(item.id)">Details</button> -->
       <router-link class="btn btn-dark p-2" :to="{ name: 'Details', params: {id: item.id} } ">Detail</router-link>
      <!-- <td><a href="details.php?id=<?php echo $data['id'] ?>" class="btn p-1 bg-success">Details</a></td> -->
     </tr>
  </tbody>

        </template>
         <div class="d-flex justify-content-center my-3">
             <button class="btn btn-dark p-2" @click="refresh">Refresh</button>
           </div>
         </template>
   <template v-else-if="arr.length>0">
        <template v-for="item in arr" :key="item.id">

       <tbody class="text-center">
     <tr>
      <td>{{item.id}}</td>
      <td>{{item.title}}</td>
      <td>{{item.category}}</td>
      <!-- <button class="btn btn-dark" @click="details(item.id)">Details</button> -->
       <router-link class="btn btn-dark p-2" :to="{ name: 'Details', params: {id: item.id} } ">Detail</router-link>
      <!-- <td><a href="details.php?id=<?php echo $data['id'] ?>" class="btn p-1 bg-success">Details</a></td> -->
     </tr>
  </tbody>

        </template>

         </template>


         <template v-else>
           <h3 class="text-center">No Data Exist In This Category</h3>
           <div class="d-flex justify-content-center my-3">
             <button class="btn btn-dark p-2" @click="refresh">Refresh</button>
           </div>

         </template>
</table>
  </div>
</template>
<script>
import { ref } from "vue";
import { onMounted } from "vue";
import { useCookies } from "vue3-cookies";
import { useRouter } from "vue-router";
export default {
  setup() {
    let arr = ref([]);
    const category = ref('')
    let item = ref('')
    const { cookies } = useCookies();
    const router = useRouter();
    onMounted(  () => {
      if (cookies.get("email")) {
          getCompanies()
      } else {
        router.push({
          name: "Login",
        });
      }
    });
    // const details = (id) =>{
    //     axios.post(`/api/details/`, id).then(()=>{
    //         router.push({
    //             name:"Details"
    //         })
    //     })
    // }
       const getCompanies = async () => {
        let response = await axios.get('/api/getItems')
        arr.value = response.data
        item.value = false
    }
    const refresh =()=>{
      category.value = ''
      getCompanies();
    }
    const search = async ()=>{
      if(category.value != ''){
        let response = await axios.get(`/api/oneData/${category.value}`)
         item.value = true
      arr.value = response.data
      console.log(category.value)
      }else{
        alert('fill the data')
        item.value = false
      }

    }
    return {
      arr,
       getCompanies,
       category,
       search,
       refresh,
       item
    };
  },
};
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');





*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.navbar{
    background-color: #4f3e9e;
    margin-bottom: 20px;
    padding: 5px;
}
.left{
    margin-left: auto;
    margin-right: 10px;
}
.left .router-reg{
    color: #fff;
    margin-right: 15px;
}
.left .router-log{
    color: #fff;

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

</style>