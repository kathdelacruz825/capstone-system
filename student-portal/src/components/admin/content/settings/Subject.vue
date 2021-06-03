<template>
  <div class="settings-subject">
    <div class="button-options">
      <el-button icon="el-icon-plus" @click="showAddSubject = true">
        Add Subject
      </el-button>
      <div class="ck-box">
        <div>
        <small>Select Semester</small>
        <el-select v-model="value" placeholder="Select Semester" @change="changeFilter">
          <el-option
            v-for="item in options"
            :key="item.value"
            :label="item.label"
            :value="item.value">
          </el-option>
        </el-select>
        </div>
        <div>
          <small>Select Year Level</small>
          <el-select class="left-margin" v-model="yearLevelValue" placeholder="Select Year Level" @change="changeFilterYearLevel">
            <el-option
              v-for="item in yearLeveloptions"
              :key="item.value"
              :label="item.label"
              :value="item.value">
            </el-option>
          </el-select>
        </div>
      </div>

    </div>
    <el-table :data="searchTable" style="width: 100%" max-height="450">
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

    <AddSubject
      :showAddSubject="showAddSubject"
      @closeAddSubject="closeAddSubject($event)"
      @updateData="updateData()"
    />

    <ViewInfoSubject
      :subjectData="subjectData"
      :showViewInfoSubject="showViewInfoSubject"
      @closeViewInfoSubject="closeViewInfoSubject($event)"
    />

    <UpdateSubject
      v-if="showUpdateSubject"
      :subjectData="subjectData"
      :showUpdateSubject="showUpdateSubject"
      @updateData="updateData()"
      @closeUpdateSubject="closeUpdateSubject($event)"
    />
  </div>
</template>

<script>
import AddSubject from "@/components/admin/content/dialog/settings/subject/AddSubject.vue";
import ViewInfoSubject from "@/components/admin/content/dialog/settings/subject/ViewInfoSubject.vue";
import UpdateSubject from "@/components/admin/content/dialog/settings/subject/UpdateSubject.vue";

import { tableProps } from "@/components/admin/content/settings/tableProps_Subject.js";
export default {
  components: {
    AddSubject,
    ViewInfoSubject,
    UpdateSubject
  },
  data() {
    return {
      options: [],
      value: 'All',
      yearLeveloptions: [],
      yearLevelValue: "All",
      currSemesterID: "",
      currYearLevelID: "",
      showAddSubject: false,
      search: "",
      tableProps: tableProps,
      tableData: [],
      subjectData: {},
      showSetActive: false,
      showSetInActive: false,
      showViewInfoSubject: false,
      showUpdateSubject: false
    };
  },
  methods: {
    changeFilter(e) {
      if (e == '0') {
        this.getAllSubject();
      } else {
        this.currSemesterID = e;
        if (!this.currYearLevelID) {
          this.getAllSubjectBySemesterOnly(e)
        } else {
          this.getAllSubjectBySemester(e, this.currYearLevelID);
        }
      }
    },
    changeFilterYearLevel(e) {
      if (e == '0') {
        this.getAllSubject();
      } else {
        this.currYearLevelID = e;
        if (!this.currSemesterID) {
          this.getAllSubjectByYearLevelOnly(e);
        } else {
          this.getAllSubjectBySemester(this.currSemesterID, e);
        }
      }
    },
    operationAction(name, itemData) {
      this.subjectData = itemData;
      switch (name) {
        case "View Info":
          this.showViewInfoSubject = true;
          break;
        case "Update":
          this.showUpdateSubject = true;
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
    getAllYearLevel() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.YearLevelService, params)
        .then(response => {
          this.yearLeveloptions.push({
            value: '0',
            label: 'All'
          });
          response.data.map((item)=> {
            this.yearLeveloptions.push({
              value: item.ID,
              label: item.YearLevel
            });
          })
        })
        .catch(error => {
          console.log(error);
        });
    },
    GetSemester() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.SemesterService, params)
        .then(response => {
            this.options.push({
              value: '0',
              label: 'All'
            });
          response.data.map((item)=> {
            this.options.push({
              value: item.ID,
              label: item.Semester
            });
          })
        })
        .catch(error => {
          console.log(error);
        });
    },
    getAllSubject() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.SubjectService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getAllSubjectBySemester(SemesterID, YearLevelID) {
      let params = {
        request: 6,
        data: {
          SemesterID: SemesterID,
          YearLevelID: YearLevelID,
        }
      };
      this.http
        .post(this.api.SubjectService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getAllSubjectBySemesterOnly(SemesterID) {
      let params = {
        request: 7,
        data: {
          SemesterID: SemesterID
        }
      };
      this.http
        .post(this.api.SubjectService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getAllSubjectByYearLevelOnly(YearLevelID) {
      let params = {
        request: 8,
        data: {
          YearLevelID: YearLevelID
        }
      };
      this.http
        .post(this.api.SubjectService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    closeAddSubject(val) {
      this.showAddSubject = val;
    },
    closeViewInfoSubject(val) {
      this.showViewInfoSubject = val;
    },
    closeUpdateSubject(val) {
      this.showUpdateSubject = val;
    },
    updateData() {
      if (this.currSemesterID && this.currYearLevelID) {
        this.getAllSubjectBySemester(this.currSemesterID, this.currYearLevelID);
      } else if (this.currSemesterID && !this.currYearLevelID) {
        this.getAllSubjectBySemesterOnly(this.currSemesterID);
      } else if (!this.currSemesterID && this.currYearLevelID) {
        this.getAllSubjectByYearLevelOnly(this.currYearLevelID);
      } else {
        this.getAllSubject();
      }
    }
  },
  computed: {
    searchTable: function() {
      if (this.search == "") return this.tableData;
      return this.tableData.filter(item => {
        return item.Code.indexOf(this.search) > -1 
        || item.Description.indexOf(this.search) > -1
        || item.Status.indexOf(this.search) > -1
        || item.Title.indexOf(this.search) > -1;
      });
    }
  },
  props: {},
  created() {
    this.GetSemester();
    this.getAllYearLevel();
    this.getAllSubject();
  },
  mounted() {},
};
</script>

<style lang="scss">
.settings {
  .ck-box {
    margin-left: 20px;
    display: flex;
    align-items: center;
  }

  .el-checkbox-group {
    margin-left: 30px;
  }
  .text-style div {
    word-break: keep-all;
  }
  .el-button.operationItem-button {
    padding: 5px;
  }
  .left-margin {
    margin-left: 20px;
  }
}
</style>
