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
                <el-select v-model="gradeType" placeholder="年级">
                    <el-option
                            v-for="(item,index) in gradeTypeOptionsForSearch"
                            :key="index"
                            :label="item.label"
                            :value="item.value">
                    </el-option>
                </el-select>
            </el-col>
            <el-col :span="2" :xs="8">
                <el-select v-model="termType" placeholder="学期">
                    <el-option
                            v-for="(item,index) in termTypeOptionsForSearch"
                            :key="index"
                            :label="item.label"
                            :value="item.value">
                    </el-option>
                </el-select>
            </el-col>
            <el-col :span="2" :xs="8">
                <el-button type="primary" icon="search" @click="handleSearch">查询</el-button>
            </el-col>
            <el-col :span="2" :xs="8">
                <el-button icon="plus" type="primary" @click="handleAdd">新增</el-button>
            </el-col>
            <el-col :span="2" :xs="8">
                <el-button icon="plus" type="primary" @click="handleUpload">导入</el-button>
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
                    label="年级">
                <template slot-scope="scope">
                    <div>
                        <span>{{ scope.row.grade|gradeFilter }}</span>
                    </div>
                </template>
            </el-table-column>
            <el-table-column
                    label="学期">
                <template slot-scope="scope">
                    <div>
                        <span>{{ scope.row.term|termFilter }}</span>
                    </div>
                </template>
            </el-table-column>
            <el-table-column
                    prop="a_first"
                    label="一A">
            </el-table-column>
            <el-table-column
                    prop="a_second"
                    label="二A">
            </el-table-column>
            <el-table-column
                    prop="a_third"
                    label="三A">
            </el-table-column>
            <el-table-column
                    prop="a_fourth"
                    label="四A">
            </el-table-column>
            <el-table-column
                    prop="a_mid"
                    label="期中A">
            </el-table-column>
            <el-table-column
                    prop="a_fifth"
                    label="五A">
            </el-table-column>
            <el-table-column
                    prop="a_sixth"
                    label="六A">
            </el-table-column>
            <el-table-column
                    prop="a_seventh"
                    label="七A">
            </el-table-column>
            <el-table-column
                    prop="a_eighth"
                    label="八A">
            </el-table-column>
            <el-table-column
                    prop="a_final"
                    label="期末A">
            </el-table-column>
            <el-table-column
                    prop="b_final"
                    label="期末B">
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
        <el-dialog title="编辑成绩" :visible.sync="dialogFormVisible">
            <el-form :model="form">
                <el-form-item label="学号" :label-width="formLabelWidth">
                    <el-input v-model="form.student_id" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="年级" :label-width="formLabelWidth">
                    <el-select v-model="form.grade" placeholder="年级">
                        <el-option
                                v-for="(item,index) in gradeTypeOptions"
                                :key="index"
                                :label="item.label"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="学期" :label-width="formLabelWidth">
                    <el-select v-model="form.term" placeholder="学期">
                        <el-option
                                v-for="(item,index) in termTypeOptions"
                                :key="index"
                                :label="item.label"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="成绩类型" :label-width="formLabelWidth">
                    <el-select @change="typeChangeHandle" v-model="type" placeholder="成绩类型">
                        <el-option
                                v-for="(item,index) in typeOptions"
                                :key="index"
                                :label="item.label"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="分数" :label-width="formLabelWidth">
                    <el-input-number v-model="point" :max="100" :step="0.5" auto-complete="off"></el-input-number>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click.native="dialogFormVisible = false">取 消</el-button>
                <el-button type="primary" @click="onSubmit()">确 定</el-button>
            </div>
        </el-dialog>
        <el-dialog title="导入成绩" :visible.sync="dialogUploadFormVisible">
            <el-form :model="form">
                <el-form-item label="年级" :label-width="formLabelWidth">
                    <el-select v-model="grade" placeholder="年级">
                        <el-option
                                v-for="(item,index) in gradeTypeOptions"
                                :key="index"
                                :label="item.label"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="学期" :label-width="formLabelWidth">
                    <el-select v-model="term" placeholder="学期">
                        <el-option
                                v-for="(item,index) in termTypeOptions"
                                :key="index"
                                :label="item.label"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="成绩类型" :label-width="formLabelWidth">
                    <el-select @change="typeChangeHandle" v-model="type" placeholder="成绩类型">
                        <el-option
                                v-for="(item,index) in typeOptions"
                                :key="index"
                                :label="item.label"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="导入excel" :label-width="formLabelWidth">
                    <el-upload
                            ref="upload"
                            :action="uploadAction"
                            :data="data"
                            :before-upload="beforeUpload"
                            :limit="1"
                            :auto-upload="false">
                        <el-button size="small" type="primary">点击上传</el-button>
                        <div slot="tip" class="el-upload__tip">只能上传1个xls/xlsx文件，且不超过2MB</div>
                    </el-upload>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click.native="dialogUploadFormVisible = false">取 消</el-button>
                <el-button type="primary" @click="upload()">确 定</el-button>
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
                gradeType: '',
                gradeTypeOptions: [
                    {
                        label: '一年级',
                        value: 1
                    },
                    {
                        label: '二年级',
                        value: 2
                    },
                    {
                        label: '三年级',
                        value: 3
                    },
                    {
                        label: '四年级',
                        value: 4
                    },
                    {
                        label: '五年级',
                        value: 5
                    },
                    {
                        label: '六年级',
                        value: 6
                    }
                ],
                gradeTypeOptionsForSearch: [
                    {
                        label: '全部',
                        value: ''
                    }
                ],
                termType: '',
                termTypeOptions: [
                    {
                        label: '上学期',
                        value: 1
                    },
                    {
                        label: '下学期',
                        value: 2
                    }
                ],
                termTypeOptionsForSearch: [
                    {
                        label: '全部',
                        value: ''
                    }
                ],
                type: 'a_first',
                typeOptions: [
                    {
                        label: '一A',
                        value: 'a_first'
                    },
                    {
                        label: '二A',
                        value: 'a_second'
                    },
                    {
                        label: '三A',
                        value: 'a_third'
                    },
                    {
                        label: '四A',
                        value: 'a_fourth'
                    },
                    {
                        label: '期中A',
                        value: 'a_mid'
                    },
                    {
                        label: '五A',
                        value: 'a_fifth'
                    },
                    {
                        label: '六A',
                        value: 'a_sixth'
                    },
                    {
                        label: '七A',
                        value: 'a_seventh'
                    },
                    {
                        label: '八A',
                        value: 'a_eighth'
                    },
                    {
                        label: '期末A',
                        value: 'a_final'
                    },
                    {
                        label: '期末B',
                        value: 'b_final'
                    }
                ],
                grade: 1,
                term: 1,
                uploadAction: '',
                data:{},
                point: 0,
                form: {},
                formLabelWidth: '120px',
                dialogFormVisible: false,
                dialogUploadFormVisible: false,
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
                this.$http.get('/grades', {params: filter}).then(response => {
                    this.tableData = response.data.data.data
                    this.currentPage = response.data.data.current_page
                    this.perPage = response.data.data.per_page
                    this.total = response.data.data.total
                });
            },
            handleUpload() {
                this.grade = 1
                this.term = 1
                this.uploadAction = this.$http.defaults.baseURL + '/grades/upload'
                this.dialogUploadFormVisible = true
            },
            beforeUpload(file) {
                this.data = {
                    grade:this.grade,
                    term:this.term,
                    type:this.type
                }
            },
            upload() {
                this.$refs.upload.submit();
            },
            //改变每页显示数量
            handleSizeChange(val) {
                this.currentPage = 1
                this.perPage = parseInt(`${val}`)
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
                this.form = row
                this.point = this.form[this.type]
                this.dialogFormVisible = true
            },
            handleDelete(id) {
                this.$confirm('此操作将永久删除该记录, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$http.delete('/grades/' + id.toString()).then(response => {
                        if (response.data.code == 200) {
                            this.$message({
                                type: 'success',
                                message: response.data.message,
                                center: true
                            });
                            this.handleSearch()
                        } else {
                            this.$message({
                                type: 'error',
                                message: response.data.message,
                                center: true
                            });
                        }
                    });

                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });
            },
            typeChangeHandle() {
                if (this.form.id) {
                    this.point = this.form[this.type]
                }
            },
            onSubmit() {
                this.form.type = this.type
                this.form.point = this.point
                if (this.form.id) {
                    this.$http.put('/grades/' + this.form.id.toString(), this.form).then(response => {
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
                    this.$http.post('/grades', this.form).then(response => {
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
            this.gradeTypeOptionsForSearch = this.gradeTypeOptionsForSearch.concat(this.gradeTypeOptions)
            this.termTypeOptionsForSearch = this.termTypeOptionsForSearch.concat(this.termTypeOptions)
            this.initData()
        }
    }
</script>

<style scoped>

</style>