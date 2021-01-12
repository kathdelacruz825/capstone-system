<template>
  <div class="settings-year-level">
    <div class="button-options">
      <el-button icon="el-icon-plus" @click="showAddYearLevel = true">
        Add Year Level
      </el-button>
    </div>
    <div class="top-options">
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
    </div>
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
              operationAction('View Info', tableData[scope.$index])
            "
          >
            {{ "View Info" }}
          </el-button>
          <el-button
            class="operationItem-button"
            size="small"
            type="warning"
            @click.native.prevent="
              operationAction('Update', tableData[scope.$index])
            "
          >
            {{ "Update" }}
          </el-button>
        </template>
      </el-table-column>
    </el-table>

    <AddYearLevel
      :showAddYearLevel="showAddYearLevel"
      @closeAddCourse="closeAddCourse($event)"
      @updateData="updateData()"
    />

    <ViewInfoYearLevel
      :YearLevelData="YearLevelData"
      :showViewInfoYearLevel="showViewInfoYearLevel"
      @closeViewInfoYearLevel="closeViewInfoYearLevel($event)"
    />

    <UpdateYearLevel
      v-if="showViewUpdateYearLevel"
      :YearLevelData="YearLevelData"
      @updateData="updateData()"
      :showViewUpdateYearLevel="showViewUpdateYearLevel"
      @closeUpdateYearLevel="closeUpdateYearLevel($event)"
    />
  </div>
</template>

<script>
import AddYearLevel from "@/components/admin/content/dialog/settings/yearlevel/AddYearLevel.vue";
import ViewInfoYearLevel from "@/components/admin/content/dialog/settings/yearlevel/ViewInfoYearLevel.vue";
import UpdateYearLevel from "@/components/admin/content/dialog/settings/yearlevel/UpdateYearLevel.vue";

import { tableProps } from "@/components/admin/content/settings/tableProps_YearLevel.js";

export default {
  components: {
    AddYearLevel,
    ViewInfoYearLevel,
    UpdateYearLevel
  },
  data() {
    return {
      showAddYearLevel: false,
      search: "",
      tableProps: tableProps,
      tableData: [],
      YearLevelData: {},
      showSetActive: false,
      showSetInActive: false,
      showViewInfoYearLevel: false,
      showViewUpdateYearLevel: false
      // operationButtons: [
      //   {
      //     name: "View Info",
      //     btnType: "info"
      //   },
      //   {
      //     name: "Update",
      //     btnType: "warning"
      //   },
      //   // {
      //   //   name: "Delete",
      //   //   btnType: "danger"
      //   // },
      //   {
      //     name: "Set Active",
      //     btnType: "success"
      //   },
      //   {
      //     name: "Set Inactive",
      //     btnType: "danger"
      //   }
      // ],
    };
  },
  methods: {
    changeVal(val) {
      console.log(val);
    },
    operationAction(name, itemData) {
      this.YearLevelData = itemData;
      switch (name) {
        case "View Info":
          this.showViewInfoYearLevel = true;
          break;
        case "Update":
          this.showViewUpdateYearLevel = true;
          break;
        // case "Delete":
        //   break;
        // case "Set Active":
        //   this.showSetActive = true;
        //   break;
        // case "Set Inactive":
        //   this.showSetInActive = true;
        //   break;
        default:
          console.log("Invalid Option");
      }
    },
    getAllYearLevel() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.YearLevelService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    closeAddCourse(val) {
      this.showAddYearLevel = val;
    },
    closeViewInfoYearLevel(val) {
      this.showViewInfoYearLevel = val;
    },
    closeUpdateYearLevel(val) {
      this.showViewUpdateYearLevel = val;
    },
    updateData() {
      this.getAllYearLevel();
    }
  },
  props: {},
  created() {
    this.getAllYearLevel();
  },
  mounted() {}
};
</script>

<style lang="scss">
.settings {
  .text-style div {
    word-break: keep-all;
  }
  .el-button.operationItem-button {
    padding: 5px;
  }
}
</style>
