import { createRouter, createWebHistory } from 'vue-router'
import Registration from './component/Registration'
import Login from './component/Login'
import Home from './component/Home'
import Activity from './component/Activity'
import Profile from './component/Profile'
import Details from './component/Details'
import Edit from './component/Edit'
// import axios from 'axios'
const routes = [
  {
    path: '/',
    name: 'Registration',
    component: Registration
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/activity',
    name: 'Activity',
    component: Activity
  },
  {
    path: '/profile',
    name: 'Profile',
    component: Profile
  },
  {
    path: '/edit/:id',
    name: 'Edit',
    component: Edit
  },
  {
    path: '/details/:id',
    name: 'Details',
    component: Details
  },
  {
    path:'/home',
    name:'Home',
    component:Home

//     beforeEnter: (to, form, next) =>{
//       axios.defaults.headers.common['Authorization'] = `bearer ${response.Authorization}`;
// axios.defaults.headers.common['Accept'] = 'application/json';
//       axios.get('/api/athenticated').then(()=>{
//           next()
//       }).catch(()=>{
//           return next({ name: 'Login'})
//       })
//   }
      // axios.get('http://127.0.0.1:8000/api/home').then(()=>{
      //     next()
      // }).catch(()=>{
      //     return next({ name: 'Login'})
      // })

  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router