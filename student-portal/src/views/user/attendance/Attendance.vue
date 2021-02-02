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
        <table>
          <tr>
            <th>Subject</th>
            <th>Time</th>
            <th>Remarks</th>
          </tr>
          <tr v-for="(item, index) in data" :key="index">
            <td>{{ item.Subject }}</td>
            <td>{{ item.Time }}</td>
            <td
              :class="
                item.Remarks == 'Present'
                  ? 'green'
                  : item.Remarks == 'Absent'
                  ? 'red'
                  : 'yellow'
              "
            >
              {{ item.Remarks }}
            </td>
          </tr>
        </table>
      </div>
    </div>
    <van-calendar v-model="show" :min-date="minDate" :max-date="maxDate" />
    <Footer :activeItem="1" />
  </div>
</template>

<script>
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";

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
      maxDate: new Date(2021, 0, 31),
      data: [
        {
          Subject: "English",
          Time: "08:00 AM - 10:00 AM",
          Remarks: "Absent"
        },
        {
          Subject: "Science",
          Time: "10:00 AM - 12:00 PM",
          Remarks: "Present"
        },
        {
          Subject: "Filipino",
          Time: "12:00 AM - 01:00 PM",
          Remarks: "Late"
        }
      ]
    };
  },
  methods: {}
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
