<template>
  <div class="schedule">
    <div class="button-options">
      <el-button icon="el-icon-plus" @click="showAddAnnounce = true">
        Add Announcement
      </el-button>
    </div>
    <!-- <div class="top-options">
      <div>
        <div style="margin-top: 15px;">
          <el-input
            placeholder="Please input to search"
            v-model="search"
            @input="changeVal"
          >
            <template slot="append">
              <i class="el-icon-search"></i>
            </template>
          </el-input>
        </div>
      </div>
    </div> -->
    <TableAnnounce @updateData="updateData" :tableData="tableData" />
    <AddAnnounce
      v-if="showAddAnnounce"
      :showAddAnnounce="showAddAnnounce"
      @closeAddAnnounce="closeAddAnnounce($event)"
      @updateData="updateData"
    />
  </div>
</template>

<script>
import TableAnnounce from "@/components/admin/content/announcements/TableAnnounce";
import AddAnnounce from "@/components/admin/content/dialog/announcements/AddAnnounce.vue";

export default {
  components: {
    TableAnnounce,
    AddAnnounce
  },
  data() {
    return {
      search: "",
      showAddAnnounce: false,
      tableData: []
    };
  },
  methods: {
    changeVal(val) {
      console.log(val);
    },
    closeAddAnnounce(val) {
      this.showAddAnnounce = val;
    },
    getAnnouncementData() {
      var params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.AdminAnnouncementService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    updateData() {
      this.getAnnouncementData();
    }
  },
  props: {},
  created() {
    this.getAnnouncementData();
  }
};
</script>
<style lang="scss">
.schedule {
  .button-options {
    text-align: left;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    margin-bottom: 10px;

    .el-button {
      padding: 10px;
    }
  }
}
</style>
