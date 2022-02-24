<template>


   <div class="d-flex justify-content-center align-items-center gap-2">

<div>
   <p><span>Title :  {{ arr.title}} </span> </p>
   <p><span>Description :  {{ arr.description}}</span> </p>
   <p><span>Category :  {{ arr.category}}</span> </p>
    <img class="image" :src="`../storage/uploads/${arr.photo}`" alt="image">
   <button class="p-2 btn btn-dark" @click="home">Back</button>
            </div>
            </div>
</template>
<script>
import { ref } from "@vue/reactivity";
import { useRouter } from "vue-router";
import { onMounted } from "vue";
import { useCookies } from "vue3-cookies";
import { useRoute } from "vue-router";
export default {
  setup() {
    const id = ref();
    const arr = ref([]);
    const router = useRouter();
    const { cookies } = useCookies();
    const route = useRoute();
    id.value = route.params.id;
    onMounted(() => {
      if (cookies.get("email")) {
          singlePost()
      } else {
        router.push({
          name: "Login",
        });
      }
    });
    const home = () =>{
        router.push({
          name: "Login",
        });
    }
    const singlePost = async () => {
     let response = await axios.get(`/api/singlePost/${route.params.id}`)
        arr.value = response.data;


    };
    return {
      arr,
      id,
      singlePost,
      home
    };
  },
};
</script>
<style scoped>
.image{
    margin-top: 10px;
    height: 200px;
    width: 200px;
    margin: 15px;
}
</style>