<template>
    <div>
        <el-row :gutter="20">
            <el-col :span="2" :xs="8">
                <el-input v-model="studentId" placeholder="学号"></el-input>
            </el-col>
            <el-col :span="2" :xs="8">
                <el-input v-model="name" placeholder="姓名"></el-input>
            </el-col>
            <el-col :span="2" :xs="8">
                <el-button type="primary" icon="search" @click="handleSearch">查询</el-button>
            </el-col>
            <el-col :span="2" :xs="8">
                <el-button icon="plus" type="primary" @click="handleAdd">新增</el-button>
            </el-col>
        </el-row>
        <br/>
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
                    label="性别">
                <template slot-scope="scope">
                    <div>
                        <span>{{ scope.row.gender|genderFilter }}</span>
                    </div>
                </template>
            </el-table-column>
            <el-table-column
                    label="状态">
                <template slot-scope="scope">
                    <div>
                        <span>{{ scope.row.status|statusFilter }}</span>
                    </div>
                </template>
            </el-table-column>
            <el-table-column
                    prop="contact"
                    label="家长手机号">
            </el-table-column>
            <el-table-column
                    fixed="right"
                    label="操作"
                    width="100">
                <template slot-scope="scope">
                    <el-button @click="handleEdit(scope.row)" type="text" size="small">编辑</el-button>
                    <el-button @click="handleDelete(scope.row.id)" type="text" size="small">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-pagination
                class="pull-right clearfix"
                @size-change="handleSizeChange"
                @current-change="handleCurrentChange"
                :current-page="currentPage"
                :page-size="perPage"
                layout="total, prev, pager, next, jumper"
                :total="total">
        </el-pagination>
        <el-dialog title="编辑管理员" :visible.sync="dialogFormVisible">
            <el-form :model="form">
                <el-form-item label="学号" :label-width="formLabelWidth">
                    <el-input-number v-model="form.student_id" :min="1" :step="1" auto-complete="off"></el-input-number>
                </el-form-item>
                <el-form-item label="姓名" :label-width="formLabelWidth">
                    <el-input v-model="form.name" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="性别" :label-width="formLabelWidth">
                    <el-radio v-model="radioGender" label="1">男</el-radio>
                    <el-radio v-model="radioGender" label="2">女</el-radio>
                </el-form-item>
                <el-form-item label="状态" :label-width="formLabelWidth">
                    <el-radio v-model="radioStatus" label="0">启用</el-radio>
                    <el-radio v-model="radioStatus" label="1">禁用</el-radio>
                </el-form-item>
                <el-form-item label="家长手机" :label-width="formLabelWidth">
                    <el-input v-model="form.contact" auto-complete="off"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click.native="dialogFormVisible = false">取 消</el-button>
                <el-button type="primary" @click="onSubmit()">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                studentId: '',
                name: '',
                form: {},
                formLabelWidth: '120px',
                dialogFormVisible: false,
                radioGender: '1',
                radioStatus: '0',
                tableData: [],
                currentPage: 1,
                perPage: 10,
                total: 0
            }
        },
        methods: {
            handleSearch() {
                let filter = {
                    page: this.currentPage
                }
                if (this.studentId) {
                    filter.student_id = this.studentId
                }
                if (this.name) {
                    filter.name = this.name
                }
                this.$http.get('/students', {params: filter}).then(response => {
                    this.tableData = response.data.data.data
                    this.currentPage = response.data.data.current_page
                    this.perPage = response.data.data.per_page
                    this.total = response.data.data.total
                });
            },
            //改变每页显示数量
            handleSizeChange(val) {
                this.currentPage = 1
                this.perPage = parseInt(`${val}`);
                this.initData();
            },
            //当前页改变
            handleCurrentChange(val) {
                this.currentPage = parseInt(`${val}`)
                this.initData()
            },
            handleAdd() {
                this.form = {}
                this.dialogFormVisible = true
            },
            handleEdit(row) {
                this.form = row;
                this.radioGender = this.form.gender.toString()
                this.radioStatus = this.form.status.toString()
                this.dialogFormVisible = true;
            },
            onSubmit() {
                this.form.gender = this.radioGender
                this.form.status = this.radioStatus
                if (this.form.id) {
                    this.$http.put('/students/' + this.form.id.toString(), this.form).then(response => {
                        if (response.data.code == 200) {
                            this.$message({
                                message: response.data.message,
                                type: 'success',
                                center: true
                            });
                            this.dialogFormVisible = false
                            this.handleSearch()
                        } else {
                            this.$message({
                                message: response.data.message,
                                type: 'error',
                                center: true
                            })
                        }
                    })
                } else {
                    this.$http.post('/students', this.form).then(response => {
                        if (response.data.code == 200) {
                            this.$message({
                                message: response.data.message,
                                type: 'success',
                                center: true
                            });
                            this.dialogFormVisible = false
                            this.handleSearch()
                        } else {
                            this.$message({
                                message: response.data.message,
                                type: 'error',
                                center: true
                            })
                        }
                    })
                }
            },
            initData() {
                this.handleSearch()
            }
        },
        mounted() {
            this.initData()
        }
    }
</script>

<style scoped>

</style>