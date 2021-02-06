<template>
  <div class="chat-support">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <div
      class="chat-support-content"
      :style="{ height: `calc(100vh - ${contentLessHeight}px)` }"
    >
      <div class="chat-wrapper">
        <div class="chat-time-start">
          <!-- <span>{{ "2020-01-21  17:12:22" }}</span> -->
        </div>
        <div
          v-for="(item, key) in messages"
          :key="key"
          class="chat-item"
          :class="messagePosition(item)"
        >
          <div class="icon">
            <van-image width="33" height="33" src="" />
          </div>
          <div class="message">
            <p>{{ item.Message }}</p>
            <div class="dt">
              <span>{{ item.TimeStamp.split(" ")[0] }}</span>
              <span>{{
                item.TimeStamp.split(" ")[1] +
                  " " +
                  item.TimeStamp.split(" ")[2]
              }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <MessageFooter
      @updateData="getAllMessageBy"
      @calcFooterHeight="calcFooterHeight($event)"
    />
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
import MessageFooter from "@/components/user/message/MessageFooter.vue";

export default {
  name: "Message",
  components: {
    Nav,
    MessageFooter
  },
  data() {
    return {
      pageTitle: "",
      userDetails: {},
      messages: [],
      message: "",
      contentLessHeight: 96,
      dataMessage: [
        {
          from: "Admin",
          message: `message from admin`,
          date: ""
        }
      ]
    };
  },
  methods: {
    getAllMessageBy() {
      let params = {
        request: 2,
        data: {
          ToUserID: this.$route.params.teacherid,
          FromUserID: this.userDetails.AccountID
        }
      };
      this.http
        .post(this.api.MessageService, params)
        .then(response => {
          this.messages = response.data;
          this.scrollToBottom();
        })
        .catch(error => {
          console.log(error);
        });
    },
    scrollToBottom() {
      var container = document.querySelector(".chat-wrapper");
      var scrollHeight = container.scrollHeight;
      container.scrollTop = scrollHeight;
    },
    calcFooterHeight(val) {
      let navHeight = 46; // DOM navigation height
      this.contentLessHeight = navHeight + val;
    },
    messagePosition(item) {
      if (item.FromUserID == this.userDetails.AccountID) {
        return "pos-right";
      } else {
        return "pos-left";
      }
    }
  },
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  },
  mounted() {
    this.getAllMessageBy();
    this.scrollToBottom();
    this.pageTitle = this.$route.params.name;
  },
  updated() {
    this.scrollToBottom();
  }
};
</script>

<style scoped>
div#app {
  padding-bottom: 0px;
}

.chat-support-content {
  overflow: hidden;
}

.dt span {
  display: block;
  font-size: 10px;
  line-height: 1.2;
  text-align: right;
}
.chat-wrapper {
  height: 100%;
  overflow-y: auto;
  padding: 0px 10px;
}

.chat-wrapper .chat-time-start {
  padding: 0px 0px 25px;
}

.chat-wrapper .chat-time-start span {
  color: #bababa;
  font-size: 13px;
}

.chat-wrapper .chat-item {
  overflow: hidden;
  display: flex;
  flex-direction: row;
  margin-bottom: 10px;
}

.chat-wrapper .chat-item .icon {
  margin-right: 12px;
}

.chat-wrapper .chat-item .icon .van-image {
  border-radius: 50%;
  border: 1px solid #fff;
}

.chat-wrapper .chat-item .message {
  background-color: #f7f7f7;
  box-shadow: 0px 0px 1px 0px rgba(203, 201, 201, 0.6);
  border-radius: 10px;
  padding: 15px 10px;
  max-width: 68%;
  overflow: hidden;
  line-height: 24px;
}

.chat-wrapper .chat-item .message p {
  margin: 0;
  text-align: left;
  font-size: 14px;
  word-break: break-all;
}

.chat-wrapper .chat-item .message .notice {
  display: flex;
  flex-direction: column;
}

.chat-wrapper .chat-item .message .notice span {
  color: #fb4242;
  text-align: left;
  font-size: 14px;
  word-break: keep-all;
}

.chat-wrapper .chat-item.pos-right {
  justify-content: end;
  flex-direction: row-reverse;
}

.chat-wrapper .chat-item.pos-left .dt span {
  text-align: left;
}
.chat-wrapper .chat-item.pos-right .icon {
  margin-right: 0px;
  margin-left: 10px;
}
</style>
