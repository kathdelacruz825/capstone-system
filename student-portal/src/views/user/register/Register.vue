<template>
  <div class="user-home">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <div class="content">
      <button type="" @click="test()">test</button>
        <van-form>
          <van-field
            v-model="data.id"
            name="ID"
            label="ID"
            placeholder="ID name"
            :rules="[{ required: true, message: 'ID is required' }]"
          />
          <van-field
            v-model="data.name"
            name="Name"
            label="Name"
            placeholder="Enter name"
            :rules="[{ required: true, message: 'Name is required' }]"
          />
          <van-field
            v-model="data.age"
            type="number"
            name="Age"
            label="Age"
            placeholder="Enter age"
            :rules="[{ required: true, message: 'Age is required' }]"
          />
          <div style="margin: 16px;">
            <van-button @click="getAllData()" round block type="info" native-type="submit">
              Get All Data
            </van-button>
            <br>
            <van-button @click="getDataBY()" round block type="info" native-type="submit">
              Get Data By
            </van-button>
            <br>
            <van-button @click="sendData()" round block type="info" native-type="submit">
              Send Data
            </van-button>
            <br>
            <van-button @click="updateData()" round block type="info" native-type="submit">
              Update Data
            </van-button>
            <br>
            <van-button @click="deleteData()" round block type="info" native-type="submit">
              Delete Data
            </van-button>
          </div>
        </van-form>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";

export default {
  name: "Register",
  components: {
    Nav
  },
  data() {
    return {
      pageTitle: "Register",
      data: {
        id: '',
        name: '',
        age: '',
      },
    };
  },
  methods: {
    getAllData() {
      var params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.SampleService, params)
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    getDataBY() {
      var params = {
        request: 2,
        data: this.data
      };
      this.http
        .post(this.api.SampleService, params)
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    sendData() {
      var params = {
        request: 3,
        data: this.data
      };
      this.http
        .post(this.api.SampleService, params)
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    updateData() {
      var params = {
        request: 4,
        data: this.data
      };
      this.http
        .post(this.api.SampleService, params)
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    deleteData() {
      var params = {
        request: 5,
        data: this.data
      };
      this.http
        .post(this.api.SampleService, params)
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
