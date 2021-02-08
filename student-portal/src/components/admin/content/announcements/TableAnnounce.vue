<template>
  <div>
    <el-table :data="searchTable" style="width: 100%" max-height="370">
      <el-table-column
        v-for="(propItem, propKey) in tableProps"
        :key="propKey"
        :prop="propItem.propName"
        :label="propItem.propLabel"
        :width="propItem.width"
        :align="propKey == 2 ? 'left' : 'center'"
        class-name="text-style"
      >
      </el-table-column>
      <el-table-column fixed="right" label="Operations" :width="'230'">
        <template slot="header" slot-scope="scope">
          <el-input
            v-model="search"
            size="mini"
            placeholder="Type to search"/>
        </template>
        <template slot-scope="scope">
          <el-button
            class="operationItem-button"
            size="small"
            type="info"
            @click.native.prevent="
              operationAction('Update', tableData[scope.$index])
            "
          >
            {{ "Update" }}
          </el-button>
          <el-button
            class="operationItem-button"
            size="small"
            type="warning"
            @click.native.prevent="
              operationAction('Delete', tableData[scope.$index])
            "
          >
            {{ "Delete" }}
          </el-button>
        </template>
      </el-table-column>
    </el-table>

    <el-dialog
      title="Delete Announcement"
      :visible.sync="showAnnouncement"
      width="20%"
      :show-close="false"
      :close-on-press-escape="false"
      :close-on-click-modal="false"
      top="50px"
    >
      <span>Are you sure you want to delete?</span>
      <span slot="footer" class="dialog-footer">
        <el-button @click="showAnnouncement = false">Cancel</el-button>
        <el-button type="primary" @click="deleteData()">Delete</el-button>
      </span>
    </el-dialog>

    <UpdateAnnounce
      v-if="showAnnouncementUpdate"
      @updateData="updateData"
      @closeUpdateAnnounce="closeUpdateAnnounce($event)"
      :showAnnouncementUpdate="showAnnouncementUpdate"
      :announceData="announceData"
    />
  </div>
</template>

<script>
import UpdateAnnounce from "@/components/admin/content/dialog/announcements/UpdateAnnounce.vue";

import { tableProps } from "@/components/admin/content/announcements/tableProps_TableAnnounce.js";

export default {
  components: {
    UpdateAnnounce
  },
  data() {
    return {
      tableProps: tableProps,
      showAnnouncement: false,
      showAnnouncementUpdate: false,
      announceData: {},
      search: "",
    };
  },
  methods: {
    operationAction(name, itemData) {
      this.announceData = itemData;
      switch (name) {
        case "Update":
          this.showAnnouncementUpdate = true;
          break;
        case "Delete":
          this.showAnnouncement = true;
          break;
        default:
          console.log("Invalid Option");
      }
    },
    deleteData() {
      let params = {
        request: 5,
        data: {
          ID: this.announceData.ID
        }
      };
      this.http
        .post(this.api.AdminAnnouncementService, params)
        .then(response => {
          if (response.data.State == 1) {
            this.showAnnouncement = false;
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
    },
    closeUpdateAnnounce(val) {
      this.showAnnouncementUpdate = val;
      this.$emit("updateData");
    },
    updateData() {
      this.$emit("updateData");
    }
  },
  props: {
    tableData: {
      type: Array,
      default: () => {
        return [];
      }
    }
  },
  computed: {
    searchTable: function() {
      if (this.search == "") return this.tableData;
      return this.tableData.filter(item => {
        return item.CreatedBy.indexOf(this.search) > -1 
        || item.Description.indexOf(this.search) > -1
        || item.Type.indexOf(this.search) > -1
        || item.Title.indexOf(this.search) > -1;
      });
    }
  },
  created() {}
};
</script>
