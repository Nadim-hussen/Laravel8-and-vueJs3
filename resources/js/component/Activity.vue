<template>
  <div class="home-head">
    <div class="d-flex justify-content-center mt-4">
      <router-link class="p-2 btn btn-dark" to="/profile"> Go Back</router-link>
    </div>

    <div class="home-bottom">
      <form action="" method="post" enctype="multipart/form-data ">
        <div class="form-title">
          <label for="title">Title &nbsp; : &nbsp;</label>
          <input
            type="text"
            v-model="form.title"
            id="title"
            placeholder="Title"
          />
          <br />
        </div>
        <div class="form-category">
          <label for="category">Category &nbsp; : &nbsp;</label>
          <input
            type="text"
            v-model="form.category"
            id="category"
            placeholder="Category"
          />
          <br />
        </div>
        <div class="form-img">
         <!-- <form enctype="multipart/form-data" @submit="submit"> -->
            <input type="file" @change="onChange" />
            <!-- <button type="submit"> submit</button> -->
        <!-- </form> -->

        </div>
        <div class="form-description">
          <textarea
            type="text"
            v-model="form.description"
            id="desc"
            cols="40"
            rows="15"
            placeholder="Enter The description of your Post"
          ></textarea>
        </div>
        <button
          type="submit"
          @click.prevent="submit"
          class="form-btn btn btn-primary"
        >
          Submit
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import { onMounted } from "vue";
import { useCookies } from "vue3-cookies";
import { useRouter } from "vue-router";
import { reactive , ref} from "vue";
export default {
  setup() {
    const { cookies } = useCookies();
    const file = ref('')
    const router = useRouter();
    // const pic = ref(null);
    // const imageprevi = ref(null)
    const form = reactive({
      title: "",
      category: "",
      description: "",
    });
     const onChange = (e)=>{
            file.value = e.target.files[0];
        }

    const submit = async (e) => {
      e.preventDefault();
        const config ={
                headers:{
                    'content-type' : 'multipart/form-data'
                }
            }
              let data = new FormData();
              data.append('title',form.title);
              data.append('category', form.category);
              data.append('email',cookies.get("email"));
            data.append('photo',file.value);
            data.append('description',form.description);

      if (
        (form.title != "" && form.category != "" && form.image != "",
        form.description != "")
      ) {
        await axios
          .post("http://127.0.0.1:8000/api/submit", data,config)
          .then(() => {
            (form.title = ""),
              (form.category = ""),
              (file.value = ""),
              (form.description = "");
            router.push({
              name: "Profile",
            });
          })
        //   .catch((e) => {
        //     errors = e.response.data.errors;
        //     console.log(e.response.data.errors);
        //   });
      } else {
        alert("fill all the field properly");
      }
    };

    onMounted(() => {
      if (cookies.get("email")) {
      } else {
        router.push({
          name: "Login",
        });
      }
    });
    return {
      submit,

      form,
      onChange,
      file,
    };
  },
};
</script>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
.head-h2 {
  font-family: "Roboto", sans-serif;
  font-size: 16px;
}
h2 {
  font-family: "Roboto", sans-serif;
  margin-top: 20px;
  color: #0771de;
  font-weight: bold;
  font-size: 1.5rem;
  text-align: center;
  text-shadow: 2px 1px #0771de;
}

.home-bottom {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  margin-top: 30px;
}
form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  font-family: "Roboto", sans-serif;
}
.form-title {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  margin-bottom: 15px;
}
.form-title input {
  width: 65%;
  padding: 5px;
}
.form-title label {
  margin-right: 10px;
  font-weight: bold;
}

.form-category {
  margin-bottom: 10px;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}
.form-category input {
  width: 65%;
  padding: 5px;
}
.form-category label {
  margin-right: 10px;
  font-weight: bold;
}
.form-img {
  margin-bottom: 10px;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}
.form-img input {
  width: 65%;
  padding: 5px;
}
.form-img label {
  margin-right: 10px;
  font-weight: bold;
}
.form-description {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}
.form-description label {
  top: 0;
}
.form-description textarea {
  resize: none;
  font-size: 1rem;
}
.form-btn {
  padding: 4px;
  margin: 10px auto;
  font-size: 15px;
  font-family: "Roboto", sans-serif;
  font-weight: bold;
}
input {
  border: 1px solid black;
}
textarea {
  border: 1px solid black;
}
</style>