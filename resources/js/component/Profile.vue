<template>
<div class="navbar">
        <span class="left">
                <router-link class="router-reg" to="/home" exact>Home</router-link>
        <router-link class="router-log" to="/profile" exact> Profile</router-link>
        </span>

    </div>
  <div>
    <div class="d-flex justify-content-center mb-4">
      <button class="btn btn-dark mx-3" @click.prevent="logout">Logout</button>
      <router-link to="/activity" class="btn btn-dark mx-3"> Create Activity</router-link>
    </div>

    <table class="table table-stripedd-flex justify-content-center">
      <thead class="text-center">
        <tr>
          <th scope="col">id</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Details</th>
        </tr>
      </thead>
      <template v-for="item in arr" :key="item.id">
        <tbody class="text-center">
          <tr>
            <td>{{ item.id }}</td>
            <td>{{ item.title }}</td>
            <td>{{ item.category }}</td>
            <td>
              <button class="btn btn-danger mx-1" @click="deleteUser(item.id)">
                Delete
              </button>
               <router-link :to="{ name: 'Edit', params: {id: item.id} }" class="btn btn-primary mx-1">
                Edit
               </router-link>
            </td>
          </tr>
        </tbody>
      </template>
    </table>
  </div>
</template>
<script>
// import { onMounted } from "@vue/runtime-core";
import { onMounted, ref } from "vue";
import { useCookies } from "vue3-cookies";
import { useRouter } from "vue-router";

export default {
  setup() {
    const arr = ref([]);
    const { cookies } = useCookies();
    const router = useRouter();
    const logout = () => {
      axios
        .post("/api/logout")
        .then(() => {
          cookies.set("email", "");
          router.push({
            name: "Login",
          });
        })
        .catch((e) => {
         console.log(e)
        });
    };
    const activity = () => {
      router.push({
        name: "Activity",
      });
    };
    const deleteUser = async (id) => {
      let response =  await axios.post(`api/deleteUser/${id}`);
      userData()
    };
    const userData = async () => {
      let response = await axios.get(`/api/userData/${cookies.get("email")}`);
      arr.value = response.data;
    };
    onMounted(() => {
      if (cookies.get("email")) {
        userData();
      } else {
        router.push({
          name: "Login",
        });
      }
    });
    return {
      logout,
      arr,
      activity,
      deleteUser,
      userData,
    };
  },
};
</script>
<style>
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
</style>