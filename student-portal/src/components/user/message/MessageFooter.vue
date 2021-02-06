<template>
  <div class="chat-footer" ref="chatfooter" id="chatfooter">
    <div class="chat-footer-wrapper">
      <!-- <div class="mic">
        <van-image width="25" height="25" src="" />
      </div> -->
      <div class="input">
        <van-field
          @keyup.enter="onEnter"
          v-model="message"
          type="textarea"
          placeholder="Enter Message"
          rows="1"
          :autosize="{ maxHeight: 96, minHeight: 16 }"
        />
      </div>
      <div class="send-button">
        <van-image
          width="30"
          height="30"
          :src="require('@/assets/icon_send.png')"
          @click="setMessageBy()"
        />
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
export default {
  name: "MessageFooter",
  components: {},
  data() {
    return {
      message: "",
      userDetails: {}
    };
  },
  props: {},
  methods: {
    setMessageBy() {
      if (this.message) {
        let params = {
          request: 3,
          data: {
            ToUserID: this.$route.params.teacherid,
            FromUserID: this.userDetails.AccountID,
            Message: this.message,
            TimeStamp: this.createTime(),
            Status: 1
          }
        };
        this.http
          .post(this.api.MessageService, params)
          .then(response => {
            if (response.data.State == 1) {
              this.$emit("updateData");
              this.message = "";
            }
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    createTime() {
      let today = new Date();
      let currdate =
        today.getFullYear() +
        "-" +
        (today.getMonth() + 1) +
        "-" +
        (today.getDate() < 10 ? "0" + today.getDate() : today.getDate());
      let currHour =
        today.getHours() < 10 ? "0" + today.getHours() : today.getHours();
      let currMinutes =
        today.getMinutes() < 10 ? "0" + today.getMinutes() : today.getMinutes();
      let currSeconds =
        today.getSeconds() < 10 ? "0" + today.getSeconds() : today.getSeconds();
      let timePeriod = today.getHours() < 13 ? "AM" : "PM";
      let currtime =
        currdate +
        " " +
        currHour +
        ":" +
        currMinutes +
        ":" +
        currSeconds +
        " " +
        timePeriod;
      return currtime;
    },
    calcFooterHeight() {
      let footerCon = document.getElementById("chatfooter");
      let footerHeight = footerCon?.getBoundingClientRect().height;
      if (this.message == "") {
        this.$emit("calcFooterHeight", 50);
      } else {
        this.$emit("calcFooterHeight", footerHeight);
      }
    },
    onEnter() {
      this.calcFooterHeight();
    }
  },
  watch: {
    message: function(val) {
      if (val != "" || val == "") {
        this.calcFooterHeight();
      }
    }
  },
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  }
};
</script>

<style scoped>
.chat-footer {
  position: fixed;
  left: 0;
  right: 0;
  bottom: 0;
}

.chat-footer .chat-footer-wrapper {
  background-color: #f8f6f6;
  box-shadow: 0px 0px 3px 0px rgba(176, 175, 175, 0.6);
  min-height: 30px;
  display: flex;
  flex-direction: row;
  overflow: hidden;
  padding: 10px 0px;
}

.chat-footer .chat-footer-wrapper .mic {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: flex-end;
}

.chat-footer .chat-footer-wrapper .input {
  flex: 6;
  padding-left: 10px;
}

.chat-footer .chat-footer-wrapper .input .van-cell {
  padding: 7px 8px;
  border-radius: 3px;
}

.chat-footer .chat-footer-wrapper .input .van-cell .van-field__control {
  line-height: 16px;
}

.chat-footer .chat-footer-wrapper .send-button {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: flex-end;
}
</style>
