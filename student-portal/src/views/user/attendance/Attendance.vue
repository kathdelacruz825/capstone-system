<template>
  <div class="attendance">
    <Nav :title="'Attendance'" :isLeftArrow="true" :isRightText="false" />
    <div class="attendance-content">
      <van-cell
        title="Select Date:"
        :value="selectedDate"
        @click="show = true"
        is-link
      />
      <div class="list">
        <table v-if="data.length > 0">
          <tr>
            <th>Subject</th>
            <th>Time</th>
            <th>Remarks</th>
          </tr>
          <tr v-for="(item, index) in data" :key="index">
            <td>{{ item.Code }}</td>
            <td>{{ item.ScheduleTimeStart + "-" + item.ScheduleTimeEnd }}</td>
            <td
              :class="
                item.RemarksID == 'Present'
                  ? 'green'
                  : item.RemarksID == 'Absent'
                  ? 'red'
                  : 'yellow'
              "
            >
              {{ item.RemarksID }}
            </td>
          </tr>
        </table>
      </div>
    </div>
    <van-calendar
      v-model="show"
      :min-date="minDate"
      :max-date="maxDate"
      @confirm="selectDate"
    />
    <Footer :activeItem="1" />
  </div>
</template>

<script>
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";
import { Toast } from "vant";

export default {
  name: "Attendance",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      currDay: 0,
      selectedDate: new Date().toISOString().substr(0, 10),
      show: false,
      minDate: new Date(2020, 0, 1),
      maxDate: new Date(),
      userDetails: {},
      data: []
    };
  },
  methods: {
    async getAttendance(dt) {
      let params = {
        request: 2,
        data: {
          AttendanceDate: dt,
          AccountID:
            this.userDetails.AccountType == "1"
              ? this.userDetails.AccountID
              : this.userDetails.StudentID
        }
      };
      await this.http
        .post(this.api.AttendanceService, params)
        .then(response => {
          this.data = response.data;
        })
        .catch(error => {
          Toast("Connection Error");
          console.log(error);
        });
    },
    formatDate(date) {
      let yyyy = date.getFullYear();
      let mm =
        date.getMonth() + 1 > 10
          ? date.getMonth() + 1
          : "0" + (date.getMonth() + 1);
      let dd = date.getDate() > 10 ? date.getDate() : "0" + date.getDate();
      return `${yyyy}-${mm}-${dd}`;
    },
    selectDate(val) {
      this.selectedDate = this.formatDate(val);
      this.getAttendance(this.selectedDate);
      this.show = false;
    }
  },
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  },
  mounted() {
    this.getAttendance(this.selectedDate);
  }
};
</script>
<style lang="scss">
.attendance {
  .attendance-content {
    height: calc(100vh - 96px);
    overflow: hidden;
  }

  .list {
    padding: 10px 0px 50px;
    height: 100%;
    overflow-y: auto;
  }
  .list .item {
    text-align: left;
  }
  .van-cell__title {
    text-align: left;
  }

  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  td,
  th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }

  tr td {
    text-align: center;
  }
  .green {
    color: green;
  }
  .red {
    color: red;
  }
  .yellow {
    color: black;
  }
  tr:nth-child(even) {
    background-color: #dddddd;
  }
}
</style>
