<template>
  <div>
    <el-container>
      <el-header>牌子分数计算器</el-header>
      <el-main>
        <div class="block">
          <span class="demonstration">选择装备</span>
          <el-cascader
            v-model="value"
            :options="options"
            :props="{ expandTrigger: 'hover' }"
            @change="handleChange"></el-cascader>
          <el-table
            :data="tableData"
            style="width: 100%">
            <el-table-column
              prop="key"
              label="属性"
              width="180">
            </el-table-column>
            <el-table-column
              prop="value"
              label="浮动区间"
              width="180">
              <template slot-scope="scope">
                <span>{{scope.row.min}}-{{scope.row.max}}</span>
              </template>
            </el-table-column>
            <el-table-column
              label="请输入"
              prop="input"
              width="180">
              <template slot-scope="scope">
                <el-input
                  type="number"
                  size="small"
                  @change="inputChange($event,scope.row.key)"
                  v-model="scope.row.input">
                </el-input>
              </template>
            </el-table-column>
          </el-table>
          <p></p>
          <span>评分：{{total}}</span>
        </div>
      </el-main>
    </el-container>
  </div>
</template>

<script>
  import {equipment} from "../../assets/equipment.js";
  import {number} from "../../assets/number";

  export default {
    data() {
      return {
        value: [],
        options: equipment,
        number: number,
        tableData: [],
        total: 0
      };
    },
    methods: {
      handleChange(value) {
        this.tableData = [];
        let chose = number[value[0]][value[1]][value[2]];
        let goal = {
          '主属性': 189,
          '内强': 756,
          '外强': 630,
          '会心': 378,
          '会效': 378,
          '命中': 189,
          '内劲': 236,
          '破防': 189
        };
        for (let key in chose) {
          let item = {
            key: key,
            min: chose[key].最小,
            max: chose[key].最大,
            input: chose[key].最小
          };
          item.weight = (item.max + item.min) / 2 / goal[key];
          this.tableData.push(item);
        }
        this.calculate();
      },
      inputChange(e, key) {
        console.log(e);
        console.log(key);
        let tmp = this.tableData;
        for (let k in tmp) {
          if (tmp[k].key === key) {
            tmp[k].input = e;
            break;
          }
        }
        this.tableData = tmp;
        this.calculate();
      },
      calculate() {
        let a = 0;
        let b = 0;
        for (let k in this.tableData) {
          let item = this.tableData[k];
          let mark = (item.input - item.min) / (item.max - item.min);
          a += mark * item.weight;
          b += item.weight;
        }
        this.total = (a * 100 / b).toFixed(2);
      }
    }
  }
</script>

<style scoped>

</style>
