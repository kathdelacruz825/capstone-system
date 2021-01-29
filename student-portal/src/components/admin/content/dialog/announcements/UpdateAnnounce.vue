<template>
  <el-dialog
    :visible.sync="showAnnouncementUpdate"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Update Announcement
    </template>
    <div class="add-course-content">
      <el-form
        :label-position="'left'"
        :model="ruleForm"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="ruleForm"
      >
        <el-divider content-position="left">Announcement Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Type:">
            <el-dropdown trigger="click" @command="selectType">
              <el-button type="primary">
                {{ currentType }}
                <i class="el-icon-arrow-down el-icon--right"></i>
              </el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item
                  v-for="(typeItem, typeKey) in typeList"
                  :key="typeKey"
                  :command="typeItem"
                >
                  {{ typeItem.Type }}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </el-form-item>

          <el-form-item label="Title:" prop="CourseID">
            <el-input v-model="newData.Title" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Description:" prop="CourseDescription">
            <el-input v-model="newData.Description" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Date:" prop="CourseDescription">
            <el-date-picker
              v-model="newData.OnDate"
              type="datetime"
              placeholder="Select date and time"
            >
            </el-date-picker>
          </el-form-item>

          <el-form-item label="Status:">
            <el-radio-group v-model="newData.Status" size="mini">
              <el-radio :label="'Active'" border>Active</el-radio>
              <el-radio :label="'Inactive'" border>Inactive</el-radio>
            </el-radio-group>
          </el-form-item>
        </div>
      </el-form>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Cancel</el-button>
      <el-button type="primary" @click="save()">Update</el-button>
    </span>
  </el-dialog>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      currentType: "---Select---",
      typeList: [],
      ruleForm: {
        Type: "",
        Title: "",
        Description: "",
        OnDate: "",
        CreatedBy: 1,
        Status: 1,
        CreatedTime: ""
      },
      newData: {}
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeUpdateAnnounce", false);
    },
    save() {
      if (this.newData.Type == "") {
        this.$message({
          type: "warning",
          message: "Select Type!"
        });
      } else if (this.newData.Title == "") {
        this.$message({
          type: "warning",
          message: "Enter Title!"
        });
      } else if (this.newData.Description == "") {
        this.$message({
          type: "warning",
          message: "Enter Description!"
        });
      } else if (this.newData.OnDate == "") {
        this.$message({
          type: "warning",
          message: "Enter Date!"
        });
      } else {
        var params = {
          request: 4,
          data: {
            ID: this.newData.ID,
            Type: this.parseItem(this.currentType),
            Title: this.newData.Title,
            Description: this.newData.Description,
            OnDate: this.formatDate(this.newData.OnDate),
            CreatedBy: this.newData.CreatedBy,
            Status: this.newData.Status == "Active" ? 1 : 2,
            CreatedTime: this.createTime()
          }
        };
        this.http
          .post(this.api.AdminAnnouncementService, params)
          .then(response => {
            if (response.data.State == 1) {
              this.$emit("updateData");
              this.$message({
                type: "success",
                message: response.data.Message
              });
            } else {
              this.$message({
                type: "warning",
                message: response.data.Message
              });
            }
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    selectType(val) {
      this.currentType = val.Type;
      // this.newData.Type = val.ID;
    },
    updateData() {
      this.$emit("updateData");
    },
    getAnnouncementType() {
      var params = {
        request: 6,
        data: {}
      };
      this.http
        .post(this.api.AdminAnnouncementService, params)
        .then(response => {
          this.typeList = response.data;
          // this.newData.Type = this.typeList.filter(val => {
          //   if (val.Type == this.newData.Type) {
          //     return val;
          //   }
          // })[0].ID;
        })
        .catch(error => {
          console.log(error);
        });
    },
    parseItem(item) {
      var newItem = this.typeList.filter(val => {
        if (val.Type == item) {
          return val;
        }
      })[0].ID;
      return newItem;
    },
    formatDate(date) {
      var d = new Date(date),
        month = "" + (d.getMonth() + 1),
        day = "" + d.getDate(),
        year = d.getFullYear(),
        time =
          d.getHours() +
          ":" +
          (d.getMinutes() < 10 ? "0" + d.getMinutes() : d.getMinutes()) +
          ":" +
          (d.getSeconds() < 10 ? "0" + d.getSeconds() : d.getSeconds());
      var timePeriod = d.getHours() < 13 ? "AM" : "PM";

      if (month.length < 2) {
        month = "0" + month;
      }
      if (day.length < 2) {
        day = "0" + day;
      }
      return `${month}-${day}-${year} ${time} ${timePeriod}`;
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
    }
  },
  props: {
    showAnnouncementUpdate: {
      type: Boolean,
      default: false
    },
    announceData: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  created() {
    this.getAnnouncementType();
  },
  mounted() {
    this.newData = this.announceData;
    this.currentType = this.newData.Type;
  }
};
</script>

<style lang="scss">
.add-course-content {
  .el-form-item__content {
    text-align: left;
  }
}
</style>
