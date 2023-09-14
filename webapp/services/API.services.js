import axios from '../lib/CustomAxios'

const createUserApi = (data) => {
    return axios.post('api/users', data)
}

const editUserApi = (id, data) => {
    return axios.put(`api/users/${id}`, data)
}

const deleteUserApi = (id) => {
    return axios.delete(`api/users/${id}`)
}

const getUserApi = (id) => {
    return axios.get(`api/users/${id}`)
}

const getListUserApi = (page, search = '', sortEmail = 'desc') => {
    return axios.get(`api/users?page=${page}&search=${search}&sort=${sortEmail}`)
}

export { createUserApi, getListUserApi, editUserApi, getUserApi, deleteUserApi }
