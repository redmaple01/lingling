import request from '@/utils/request'

//登录
export function login(params) {
  return request({
    url: '/api/base/staffLogin',
    method: 'post',
    data: params
  })
}

//获取用户
export function member(params) {
  return request({
    url: '/api/index/member',
    method: 'get',
    data
  })
}


//获取工作订单
export function getOrder(params) {
  return request({
    url: '/api/staff/order',
    method: 'get',
    params
  })
}

//接单
export function setStaffOrder(params) {
  return request({
    url: '/api/staff/staffOrder',
    method: 'post',
    data: params
  })
}

export function getStaffOrder(params) {
  return request({
    url: '/api/staff/staffOrder',
    method: 'get',
    params
  })
}




