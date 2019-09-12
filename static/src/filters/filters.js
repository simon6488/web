const genderFilter = function (val) {
    return val == 1 ? '男' : '女'
}

const statusFilter = function (val) {
    switch (val) {
        case 0:
            val = '启用'
            break
        case 1:
            val = '禁用'
            break
    }
    return val
}

const gradeFilter = function (val) {
    switch (val) {
        case 1:
            val = '一年级'
            break
        case 2:
            val = '二年级'
            break
        case 3:
            val = '三年级'
            break
        case 4:
            val = '四年级'
            break
        case 5:
            val = '五年级';
            break
        case 6:
            val = '六年级';
            break
    }
    return val
}

const termFilter = function (val) {
    switch (val) {
        case 1:
            val = '上学期'
            break
        case 2:
            val = '下学期'
            break
    }
    return val
}

export default {
    genderFilter,
    statusFilter,
    gradeFilter,
    termFilter
}