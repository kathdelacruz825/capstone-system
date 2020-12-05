import axios from "axios";

var instance = axios.create({
  // baseURL: "https://kathdelacruz.com/server",
  baseURL: "http://localhost/studentportal-server",
  timeout: 6000
});

class http {
  static async get(url, params) {
    return await instance.get(url, { params });
  }

  static async post(url, params) {
    return await instance.post(url, JSON.stringify(params));
  }
}

export default http;
