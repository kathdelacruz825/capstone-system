<template>
  <div>
    <el-table :data="tableData" style="width: 100%" max-height="370">
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
  
  </div>
</template>

<script>
import { tableProps } from "@/components/admin/content/announcements/tableProps_TableAnnounce.js";

export default {
  components: {},
  data() {
    return {
      tableProps: tableProps,
      showAnnouncement: false,
      showAnnouncementUpdate: false,
      announceData: {},
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
            this.getAnnouncementData();
            this.showAnnouncement = false;
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
  props: {
    tableData: {
      type: Array,
      default: () => {
        return [];
      }
    },
  },
  created() {}
};
</script>
