<template>
  <div class="settings-grading-perion">
    <div class="button-options">
      <el-button icon="el-icon-plus" @click="showAddGradingPeriod = true">
        Add Grading Period
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
    <el-table :data="searchTable" style="width: 100%" max-height="370">
      <el-table-column
        v-for="(propItem, propKey) in tableProps"
        :key="propKey"
        :prop="propItem.propName"
        :label="propItem.propLabel"
        :width="propItem.width"
        :align="propKey == 2 && propKey == 4 ? 'center' : 'left'"
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

    <AddGradingPeriod
      :showAddGradingPeriod="showAddGradingPeriod"
      @closeAddGradingPeriod="closeAddGradingPeriod($event)"
      @updateData="updateData()"
    />

    <ViewInfoGradingPeriod
      :gradingPeriodData="gradingPeriodData"
      :showViewInfoGradingPeriod="showViewInfoGradingPeriod"
      @closeViewInfoGradingPeriod="closeViewInfoGradingPeriod($event)"
    />

    <UpdateGradingPeriod
      v-if="showUpdateGradingPeriod"
      :gradingPeriodData="gradingPeriodData"
      :showUpdateGradingPeriod="showUpdateGradingPeriod"
      @updateData="updateData()"
      @closeUpdateGradingPeriod="closeUpdateGradingPeriod($event)"
    />
  </div>
</template>

<script>
import AddGradingPeriod from "@/components/admin/content/dialog/settings/gradingperiod/AddGradingPeriod.vue";
import ViewInfoGradingPeriod from "@/components/admin/content/dialog/settings/gradingperiod/ViewInfoGradingPeriod.vue";
import UpdateGradingPeriod from "@/components/admin/content/dialog/settings/gradingperiod/UpdateGradingPeriod.vue";

import { tableProps } from "@/components/admin/content/settings/tableProps_GradingPeriod.js";

export default {
  components: {
    AddGradingPeriod,
    ViewInfoGradingPeriod,
    UpdateGradingPeriod
  },
  data() {
    return {
      showAddGradingPeriod: false,
      search: "",
      tableProps: tableProps,
      tableData: [],
      gradingPeriodData: {},
      showSetActive: false,
      showSetInActive: false,
      showViewInfoSubject: false,
      showUpdateGradingPeriod: false,
      showViewInfoGradingPeriod: false
    };
  },
  methods: {
    changeVal(val) {
      console.log(val);
    },
    operationAction(name, itemData) {
      this.gradingPeriodData = itemData;
      switch (name) {
        case "View Info":
          this.showViewInfoGradingPeriod = true;
          break;
        case "Update":
          this.showUpdateGradingPeriod = true;
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
        .post(this.api.GradingPeriodService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    closeAddGradingPeriod(val) {
      this.showAddGradingPeriod = val;
    },
    closeViewInfoGradingPeriod(val) {
      this.showViewInfoGradingPeriod = val;
    },
    closeUpdateGradingPeriod(val) {
      this.showUpdateGradingPeriod = val;
    },
    updateData() {
      this.getAllGradingPeriod();
    }
  },
  computed: {
    searchTable: function() {
      if (this.search == "") return this.tableData;
      return this.tableData.filter(item => {
        return item.Status.indexOf(this.search) > -1 
        || item.Title.indexOf(this.search) > -1;
      });
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
