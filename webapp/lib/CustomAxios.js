import axios from 'axios'

const instance = axios.create({
    baseURL: 'http://localhost:8002',
    timeout: 3000,
});

// Add a response interceptor
instance.interceptors.response.use(function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // Do something with response data
    return response && response.data ? response.data : response;
}, function (error) {
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error
    return error && error.response.data ? Promise.reject(error.response.data) : Promise.reject(error);
});

export default instance
