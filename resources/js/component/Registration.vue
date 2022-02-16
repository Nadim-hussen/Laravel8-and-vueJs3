<template>
<div class="navbar">
        <span class="left">
                <router-link class="router-reg" to="/" exact>Registration</router-link>
        <router-link class="router-log" to="/login" exact> Login</router-link>
        </span>

    </div>
  <div>
    <div class="form-head">
      <div class="sub-head">
        <h2 class="form-h2">Registration</h2>

        <div class="form-name">
          <label class="form-label" for="name">Name &nbsp; : &nbsp;</label>
          <input
            type="text"
            v-model="form.name"
            id="name"
            autocomplete="off"
            placeholder="Enter your name"
          />
          <span class="bg-danger" v-if="errors.name">{{ errors.name[0] }}</span>
          <br />
        </div>
        <div class="form-email">
          <label class="form-label" for="email">Email &nbsp; : &nbsp;</label>
          <input
            type="email"
            v-model="form.email"
            autocomplete="off"
            placeholder="Enter your email"
          /><span v-if="errors.email">{{ errors.email[0] }}</span>
          <br />
        </div>
        <div class="form-password">
          <label class="form-label" for="password"
            >Password &nbsp; : &nbsp;</label
          >
          <input
            type="password"
            v-model="form.password"
            id="password"
            autocomplete="off"
            placeholder="Enter your password"
          /><span v-if="errors.password">{{ errors.password[0] }}</span>
          <br />
        </div>

        <div class="form-phone">
          <label class="form-label" for="phone">Phone &nbsp; : &nbsp;</label>
          <input
            type="number"
            v-model="form.phone"
            id="phone"
            autocomplete="off"
            placeholder="Enter phone number"
          /><span v-if="errors.phone">{{ errors.phone[0] }}</span>
          <br />
        </div>
        <div class="form-button">
          <button class="form-btn" type="button" @click="storeUser">
            Submit
          </button>
        </div>

        <p class="form-redirect">
          Have an account? <router-link to="/login"> Log in now</router-link>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import { onMounted } from "vue";
import { useCookies } from "vue3-cookies";
export default {
  setup() {
    let errors = ref([]);
    const router = useRouter();
    const { cookies } = useCookies();
    const form = reactive({
      name: "",
      email: "",
      password: "",
      phone: "",
    });
    onMounted(() => {
      if (cookies.get("email")) {
        router.push({
          name: "Home",
        });
      } else {
      }
    });
    const storeUser = async () => {
      if (
        form.name != "" &&
        form.email != "" &&
        form.password != "" &&
        form.phone != ""
      ) {
        await axios
          .post("http://127.0.0.1:8000/api/users", {
            name: form.name,
            email: form.email,
            password: form.password,
            phone: form.phone,
          })
          .then(() => {
            (form.name = ""),
              (form.email = ""),
              (form.password = ""),
              (form.phone = "");
            router.push({
              name: "Login",
            });
          })
          .catch((e) => {
            errors = e.response.data.errors;
            console.log(e.response.data.errors);
          });
      } else {
        alert("fill all the field properly");
      }
    };
    return {
      form,
      storeUser,
      errors,
    };
  },
};
</script>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap");
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
.form-head {
  height: 100vh;
  width: 100vw;
  display: flex;
  justify-content: center;
  align-items: center;
}
.sub-head {
  display: flex;
  flex-direction: column;
  justify-content: center;
  background-color: #4d918c;
  padding: 15px;
}
.sub-head h2 {
  font-family: "Roboto", sans-serif;
}
.form-button {
  display: flex;
  justify-content: center;
}
form,
.form-h2 {
  text-align: center;
  font-family: "Roboto", sans-serif;
}
.form-btn {
  padding: 5px;
  background-color: #053668;
  font-size: 0.8rem;
  font-weight: 800;
  color: #fff;
  font-family: "Roboto", sans-serif;
  outline: none;
  border: 1px solid #789beb;
  border-radius: 5px;
}
.form-label {
  font-weight: 600;
}
.form-name {
  margin-bottom: 10px;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}
.form-email {
  margin-bottom: 10px;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.form-phone {
  margin-bottom: 10px;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}
.form-password {
  margin-bottom: 10px;
  display: flex;
  justify-content: flex-start;
  align-items: center;
}
.form-redirect {
  font-weight: 700;
  text-align: center;
  font-family: "Roboto", sans-serif;
  margin-top: 10px;
}
a {
  color: #053668;
  font-weight: 900;
}
</style>