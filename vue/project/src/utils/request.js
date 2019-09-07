import axios from 'axios'
import store from '@/store/store'

// 创建axios实例
const service = axios.create({
  baseURL: process.env.API_ROOT, // api的base_url
  timeout: 15000 // 请求超时时间
})

// request拦截器
service.interceptors.request.use(config => {
  // 根据推测，实际上使用Token的主要原因在于跨域请求
  if (store.state.token) {
    config.headers['Token'] = store.state.token  // 让每个请求携带自定义token 请根据实际情况自行修改
  }

   return config
}, error => {
  // Do something with request error
  console.log(error) // for debug
  return Promise.reject(error)
})

// respone拦截器
service.interceptors.response.use(
  response => {
    const res = response.data
    return response.data
  },
  error => {
    console.log('err' + error) // for debug
    return Promise.reject(error)
  }
)

export default service
