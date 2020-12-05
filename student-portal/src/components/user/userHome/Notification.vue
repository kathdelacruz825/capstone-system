<template>
  <div class="notification">
    <div class="notification-content">
      <div class="notification-panel">
        <div class="head-panel">
          <div class="icon">
            <van-image
              width="50px"
              height="50px"
              fit="contain"
              src="https://img.yzcdn.cn/vant/cat.jpeg"
            />
          </div>
          <div class="name">
            <span>{{ "Pepito Manalastas" }}</span>
            <span>{{ "Teacher" }}</span>
            <span>{{ "Dec 05, 3:00 PM" }}</span>
          </div>
        </div>
        <div class="body-panel">
          <div class="activty-type">
            <van-icon name="newspaper-o" />
            {{ "Quiz" }}
          </div>
          <div class="activity-name">First Quiz</div>
          <div class="activity-schedule">{{ "December 7, 2020 7:00AM" }}</div>
          <div class="activity-content">
            <p>HTML How to make lumpi</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Notification",
  data() {
    return {};
  }
};
</script>

<style lang="scss">
.notification {
  .notification-panel {
    padding: 10px;
  }
  .head-panel {
    display: flex;
    flex-direction: row;

    .icon {
      margin-right: 10px;
      // .van-image img {
      //   border-radius: 50%;
      // }
    }
    .name {
      display: flex;
      flex-direction: column;
      text-align: left;
      line-height: 16px;
      font-size: 15px;
    }
  }

  .body-panel {
    text-align: left;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
  }
}
</style>
