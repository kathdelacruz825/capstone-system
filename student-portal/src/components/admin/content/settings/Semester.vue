<template>
  <div class="semester">
    <div class="button-options">
      <el-button icon="el-icon-plus" @click="showAddSemester = true">
        Add Semester
      </el-button>
    </div>
    <el-table :data="searchTable" style="width: 100%" max-height="370">
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
        <template slot="header" slot-scope="scope">
          <el-input
            v-model="search"
            size="mini"
            placeholder="Type to search"/>
        </template>
        <template slot-scope="scope">
          <el-button
            class="operationItem-button"
            :disabled="tableData[scope.$index].Status == 'Inactive' ? false : true"
            size="small"
            :type="tableData[scope.$index].Status == 'Inactive' ? 'success' : 'danger'"
            @click.native.prevent="
              operationAction('SetStatus', tableData[scope.$index])
            "
          >
            {{ tableData[scope.$index].Status == 'Inactive' ? 'Set Active' : tableData[scope.$index].Status}}
          </el-button>
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

    <AddSemester
      :showAddSemester="showAddSemester"
      @closeAddSemester="closeAddSemester($event)"
      @updateData="updateData()"
    />

    <ViewInfoSemester
      :semesterData="semesterData"
      :showViewInfoSemester="showViewInfoSemester"
      @closeViewInfoSemester="closeViewInfoSemester($event)"
    />

    <UpdateSemester
      v-if="showUpdateSemester"
      :semesterData="semesterData"
      :showUpdateSemester="showUpdateSemester"
      @updateData="updateData()"
      @closeUpdateSemester="closeUpdateSemester($event)"
    />
  </div>
</template>

<script>
import AddSemester from "@/components/admin/content/dialog/settings/semester/AddSemester.vue";
import UpdateSemester from "@/components/admin/content/dialog/settings/semester/UpdateSemester.vue";
import ViewInfoSemester from "@/components/admin/content/dialog/settings/semester/ViewInfoSemester.vue";

import { tableProps } from "@/components/admin/content/settings/tableProps_Semester.js";

export default {
  components: {
    AddSemester,
    UpdateSemester,
    ViewInfoSemester
  },
  data() {
    return {
      showAddSemester: false,
      search: "",
      tableProps: tableProps,
      tableData: [],
      semesterData: {},
      showViewInfoSemester: false,
      showUpdateSemester: false,
      showViewInfoSchoolYear: false
    };
  },
  methods: {
    GetSemester() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.SemesterService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    UpdateSemesterStatus(id) {
      let params = {
        request: 5,
        data: {
          ID: id
        }
      };
      this.http
        .post(this.api.SemesterService, params)
        .then(response => {
          this.GetSemester();
        })
        .catch(error => {
          console.log(error);
        });
    },
    MultipleUpdateSemester(id) {
      let params = {
        request: 6,
        data: {}
      };
      this.http
        .post(this.api.SemesterService, params)
        .then(response => {
          this.UpdateSemesterStatus(id)
        })
        .catch(error => {
          console.log(error);
        });
    },
    operationAction(name, itemData) {
      this.semesterData = itemData;
      switch (name) {
        case "View Info":
          this.showViewInfoSemester = true;
          break;
        case "Update":
          this.showUpdateSemester = true;
          break;
        case "SetStatus":
          this.MultipleUpdateSemester(this.semesterData.ID);
          break;
        default:
          console.log("Invalid Option");
      }
    },
    closeAddSemester(val) {
      this.showAddSemester = val;
    },
    closeViewInfoSemester(val) {
      this.showViewInfoSemester = val;
    },
    closeUpdateSemester(val) {
      this.showUpdateSemester = val;
    },
    updateData() {
      this.GetSemester();
    }
  },
  props: {},
  computed: {
    searchTable: function() {
      if (this.search == "") return this.tableData;
      return this.tableData.filter(item => {
        return item.Semester.indexOf(this.search) > -1 
        || item.Status.indexOf(this.search) > -1;
      });
    }
  },
  created() {},
  mounted() {
    this.GetSemester();
  }
};
</script>
