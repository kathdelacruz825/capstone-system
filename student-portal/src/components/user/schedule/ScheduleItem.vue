<template>
  <div class="schedule-item">
    <div class="schedule-item-content">
      <div
        v-for="(scheduleItem, scheduleKey) in scheduleData"
        :key="scheduleKey"
        class="item"
      >
        <div class="left">
          <van-tag class="tag" color="#7232dd" type="danger"></van-tag>
        </div>
        <div class="right">
          <span class="subject-name">{{ scheduleItem.ScheduleDayID }}</span>
          <span class="start-end-time">
            {{
              scheduleItem.ScheduleTimeStart +
                " - " +
                scheduleItem.ScheduleTimeEnd
            }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ScheduleItem",
  components: {},
  data() {
    return {};
  },
  methods: {},
  props: {
    scheduleData: {
      type: Array,
      default() {
        return [];
      }
    }
  },
  mounted() {
    // console.log(this.scheduleData);
  }
};
</script>
<style lang="scss">
.schedule-item {
  .schedule-item-content {
    padding: 10px 10px 0px;
  }
  .item {
    display: flex;
    flex-direction: row;
    align-items: center;
    height: 40px;
    border-bottom: 1px solid #ccc;
    .left {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .right {
      flex: 6;
    }
    .tag {
      height: 20px;
      width: 20px;
    }
  }

  .item:not(:last-child) {
    margin-bottom: 10px;
  }
}
</style>
