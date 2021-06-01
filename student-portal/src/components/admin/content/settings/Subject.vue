<template>
  <div class="settings-subject">
    <div class="button-options">
      <el-button icon="el-icon-plus" @click="showAddSubject = true">
        Add Subject
      </el-button>
      <div class="ck-box">
      <el-checkbox
       :indeterminate="isIndeterminate" 
       v-model="checkAll" 
       @change="handleCheckAllChange">All</el-checkbox>
      <el-checkbox-group v-model="checkedCities" @change="handleCheckedCitiesChange">
        <el-checkbox v-for="city in cities" :label="city" :key="city">{{city}}</el-checkbox>
      </el-checkbox-group>
      </div>

    </div>
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
var cityOptions = [];
export default {
  components: {
    AddSubject,
    ViewInfoSubject,
    UpdateSubject
  },
  data() {
    return {
      checkAll: false,
      checkedCities: [],
      cities: cityOptions,
      isIndeterminate: true,
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
    handleCheckAllChange(val) {
        this.checkedCities = val ? cityOptions : [];
        this.isIndeterminate = false;
        if (val == false) {
          this.checkAll = true;
          this.checkedCities = [];
        }
    },
    handleCheckedCitiesChange(value) {
      let checkedCount = value.length;
      this.checkAll = checkedCount === this.cities.length;
      this.isIndeterminate = checkedCount > 0 && checkedCount < this.cities.length;
      if (value.length == 0) {
        this.checkAll = true;
      }
    },
    operationAction(name, itemData) {
      this.subjectData = itemData;
      console.log(this.subjectData);
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
    GetSemester() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.SemesterService, params)
        .then(response => {
          cityOptions = [];
          this.checkedCities = [];
          response.data.map((item)=> {
            cityOptions.push(item.Semester);
            this.checkedCities.push(item.Semester);
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
      this.getAllSubject();
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
    this.getAllSubject();
    this.GetSemester();
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
}
</style>
