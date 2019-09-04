<template>
    <el-row>

    </el-row>
    <el-table
            :data="tableData"
            border
            style="width: 100%">
        <el-table-column
                prop="student_id"
                label="学号"
                width="180">
        </el-table-column>
        <el-table-column
                prop="name"
                label="姓名"
                width="180">
        </el-table-column>
        <el-table-column
                prop="address"
                label="地址">
        </el-table-column>
    </el-table>
</template>

<script>
    export default {
        name: "Student",
        data() {
            return {
                tableData: [
                    {
                        student_id: 1,
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1518 弄'
                    },
                    {
                        student_id: 2,
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1517 弄'
                    },
                    {
                        student_id: 3,
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1519 弄'
                    },
                    {
                        student_id: 4,
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1516 弄'
                    }
                ]
            }
        },
        methods:{

        }
    }
</script>

<style scoped>

</style>