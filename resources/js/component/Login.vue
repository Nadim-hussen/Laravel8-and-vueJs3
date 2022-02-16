<template>
 <div class="navbar">
        <span class="left">
                <router-link class="router-reg" to="/" exact>Registration</router-link>
        <router-link class="router-log" to="/login" exact> Login</router-link>
        </span>

    </div>
  <div class="form-head">
    <div class="sub-head">
      <h2 class="form-h2">User Login</h2>
      <form action="" method="post">
        <div class="form-email">
          <label class="form-label" for="email">Email &nbsp; : &nbsp;</label>
          <input
            type="email"
            v-model="userLogin.email"
            autocomplete="off"
            placeholder="Enter your email"
          /><br />
        </div>
        <div class="form-password">
          <label class="form-label" for="password"
            >Password &nbsp; : &nbsp;</label
          >
          <input
            type="password"
            v-model="userLogin.password"
            id="password"
            autocomplete="off"
            placeholder="Enter your password"
          />
          <br />
        </div>
        <div class="form-button">
          <button
            class="form-btn"
            name="submit"
            type="submit"
            @click.prevent="login"
          >
            Submit
          </button>
        </div>
      </form>
      <p class="form-redirect">
        Don't have an account? <router-link to="/"> Sign Up</router-link>
      </p>
    </div>
  </div>
</template>
<script>
import { reactive } from "vue";
import { useRouter } from "vue-router";
import { onMounted } from "vue";
import { useCookies } from "vue3-cookies";

export default {

  setup() {
    const { cookies } = useCookies();
    const router = useRouter();
    const userLogin = reactive({
      email: "",
      password: "",
    });
    onMounted(() => {
      if (cookies.get("email")) {
         router.push({
          name: "Home",
        });
      } else {

      }
    });
    const login = async () => {
      if (userLogin.email != "" && userLogin.password != "") {
        await axios
          .post("http://127.0.0.1:8000/api/login", {
            email: userLogin.email,
            password: userLogin.password

          })
          .then(() => {

             cookies.set('email', userLogin.email);
             (userLogin.email = ""), (userLogin.password = "");
            router.push({
              name: "Home",
            });
          })

          .catch((e) => {
            console.log(e.message);
          });
      } else {
        alert("plz enter the all field properly");
      }
    };
    return {
      userLogin,
      login,
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
.navbar{
    background-color: #4f3e9e;
    margin-bottom: 20px;
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