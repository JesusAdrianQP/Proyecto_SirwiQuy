import axios from "axios";

axios.defaults.headers.common['Authorization'] = localStorage.getItem('jwt_token');
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

import { API_URL } from "./constants.js"

export default {
  async get(url) {
    try {
      let response = await axios.get(`${API_URL}${url}`)
      console.log(response)
      return {
        ok: true,
        data: response
      }
    } catch (error) {
       if (error.response) {
        console.log(error.response.data);
        console.log(error.response.status);
        return {
          ok: false,
          error: error.response.data
        }
      } else if (error.request) {
        console.log(error.request);
      } else {
        console.log('Error', error.message);
      }
      return {
        ok: false,
        error: 'Ocurrió un error, vuelva a intentarlo'
      }
    }    
  },
  async post(url, body) {
    try {
      let response = await axios.post(`${API_URL}${url}`, body)
      console.log(response)
      return {
        ok: true,
        data: response
      }
    } catch (error) {
       if (error.response) {
        console.log(error.response.data);
        console.log(error.response.status);
        return {
          ok: false,
          error: error.response.data
        }
      } else if (error.request) {
        console.log(error.request);
      } else {
        console.log('Error', error.message);
      }
      return {
        ok: false,
        error: 'Ocurrió un error, vuelva a intentarlo'
      }
    }
  }
}