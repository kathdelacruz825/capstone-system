<template>
  <div class="chat-support">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <div
      class="chat-support-content"
      :style="{ height: `calc(100vh - ${contentLessHeight}px)` }"
    >
      <div class="chat-wrapper">
        <div class="chat-time-start">
          <span>{{ "2020-01-21  17:12:22" }}</span>
        </div>
        <div v-for="(item, key) in dataMessage" :key="key" class="chat-item">
          <div class="icon">
            <van-image width="33" height="33" src="" />
          </div>
          <div class="message">
            <p>{{ item.message }}</p>
          </div>
        </div>
      </div>
    </div>
    <MessageFooter />
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
      pageTitle: "Message",
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
  methods: {}
};
</script>

<style scoped>
div#app {
  padding-bottom: 0px;
}

.chat-support-content {
  overflow: hidden;
}

.chat-wrapper {
  height: 100%;
  overflow-y: auto;
  padding: 0px 10px;
}

.chat-wrapper .chat-time-start {
  padding: 10px 0px 25px;
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

.chat-wrapper .chat-item.pos-right .icon {
  margin-right: 0px;
  margin-left: 10px;
}
</style>
