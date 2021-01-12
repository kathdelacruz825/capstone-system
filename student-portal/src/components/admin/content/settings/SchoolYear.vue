<template>
  <div class="settings-school-year">
    <div class="button-options">
      <el-button icon="el-icon-plus" @click="showAddSchoolYear = true">
        Add School Year
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
        :align="'center'"
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

    <AddSchoolYear
      :showAddSchoolYear="showAddSchoolYear"
      @closeAddAddSchoolYear="closeAddAddSchoolYear($event)"
      @updateData="updateData()"
    />

    <ViewInfoSchoolYear
      :schoolYearData="schoolYearData"
      :showViewInfoSchoolYear="showViewInfoSchoolYear"
      @closeViewInfoSchoolYear="closeViewInfoSchoolYear($event)"
    />

    <UpdateSchoolYear
      v-if="showUpdateSchoolYear"
      :schoolYearData="schoolYearData"
      :showUpdateSchoolYear="showUpdateSchoolYear"
      @updateData="updateData()"
      @closeUpdateSchoolYear="closeUpdateSchoolYear($event)"
    />
  </div>
</template>

<script>
import AddSchoolYear from "@/components/admin/content/dialog/settings/schoolyear/AddSchoolYear.vue";
import ViewInfoSchoolYear from "@/components/admin/content/dialog/settings/schoolyear/ViewInfoSchoolYear.vue";
import UpdateSchoolYear from "@/components/admin/content/dialog/settings/schoolyear/UpdateSchoolYear.vue";

import { tableProps } from "@/components/admin/content/settings/tableProps_SchoolYear.js";

export default {
  components: {
    AddSchoolYear,
    ViewInfoSchoolYear,
    UpdateSchoolYear
  },
  data() {
    return {
      showAddSchoolYear: false,
      search: "",
      tableProps: tableProps,
      tableData: [],
      schoolYearData: {},
      showSetActive: false,
      showSetInActive: false,
      showViewInfoSubject: false,
      showUpdateSchoolYear: false,
      showViewInfoSchoolYear: false
    };
  },
  methods: {
    changeVal(val) {
      console.log(val);
    },
    operationAction(name, itemData) {
      this.schoolYearData = itemData;
      switch (name) {
        case "View Info":
          this.showViewInfoSchoolYear = true;
          break;
        case "Update":
          this.showUpdateSchoolYear = true;
          break;
        // case "Delete":
        //   break;
        case "Set Active":
          this.showSetActive = true;
          break;
        case "Set Inactive":
          this.showSetInActive = true;
          break;
        default:
          console.log("Invalid Option");
      }
    },
    getAllGradingPeriod() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.SchoolYearService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    closeAddAddSchoolYear(val) {
      this.showAddSchoolYear = val;
    },
    closeViewInfoSchoolYear(val) {
      this.showViewInfoSchoolYear = val;
    },
    closeUpdateSchoolYear(val) {
      this.showUpdateSchoolYear = val;
    },
    updateData() {
      this.getAllGradingPeriod();
    }
  },
  props: {},
  created() {
    this.getAllGradingPeriod();
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
