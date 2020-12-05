<template>
  <div class="notification">
    <div class="notification-content">
      <div class="notification-panel">
        <div class="head-panel">
          <div class="icon"></div>
          <div class="name">
            <span>name of teacher</span>
            <span>position</span>
            <span>time and icon</span>
          </div>
        </div>
        <div class="body-panel">
          <div class="activty-type">icon and Quiz</div>
          <div class="activity-name">activty name</div>
          <div class="activity-schedule"></div>
          <div class="activity-content">
            <p></p>
            <van-button round block type="info" native-type="submit">
              button
            </van-button>
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
