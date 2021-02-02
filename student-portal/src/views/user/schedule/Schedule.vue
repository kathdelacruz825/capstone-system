<template>
  <div class="schedule">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <div class="schedule-content">
      <van-tabs v-model="active" animated @click="changeTab">
        <van-tab
          v-for="(dayItem, dayKey) in dayItems"
          :key="dayKey"
          :title="dayItem.Day"
        >
          <ScheduleItem :scheduleData="scheduleData" />
        </van-tab>
      </van-tabs>
    </div>
    <Footer :activeItem="1" />
  </div>
</template>

<script>
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";
import ScheduleItem from "@/components/user/schedule/ScheduleItem.vue";
import { Toast } from "vant";

export default {
  name: "Schedule",
  components: {
    Nav,
    Footer,
    ScheduleItem
  },
  data() {
    return {
      pageTitle: "Schedule",
      userDetails: {},
      active: 0,
      dayItems: [],
      scheduleData: []
    };
  },
  methods: {
    async getDay() {
      let params = {
        request: 2,
        data: {}
      };
      await this.http
        .post(this.api.ScheduleService, params)
        .then(response => {
          this.dayItems = response.data;
          this.getSchedule(this.active);
        })
        .catch(error => {
          Toast("Connection Error");
          console.log(error);
        });
    },
    async getSchedule(ScheduleDayID) {
      let params = {
        request: 6,
        data: {
          AccountID:
            this.userDetails.AccountType == "1"
              ? this.userDetails.AccountID
              : this.userDetails.StudentID,
          ScheduleDayID: ScheduleDayID + 1
        }
      };
      await this.http
        .post(this.api.ScheduleService, params)
        .then(response => {
          this.scheduleData = response.data;
        })
        .catch(error => {
          Toast("Connection Error");
          console.log(error);
        });
    },
    changeTab(val) {
      this.getSchedule(val);
    }
  },
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  },
  mounted() {
    this.getDay();
  }
};
</script>
<style lang="scss">
.schedule {
  .schedule-content {
    height: calc(100vh - 96px);
    padding: 10px;
    overflow: hidden;
  }
}
</style>
