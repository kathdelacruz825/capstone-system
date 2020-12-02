<template>
  <div class="chat-footer" ref="chatfooter" id="chatfooter">
    <div class="chat-footer-wrapper">
      <div class="mic">
        <van-image width="25" height="25" src="" />
      </div>
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
        <van-image width="30" height="30" src="" />
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
      message: ""
    };
  },
  props: {},
  methods: {}
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
