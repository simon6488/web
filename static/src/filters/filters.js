const genderFilter = function (val) {
    return val == 1 ? '男' : '女'
}

const statusFilter = function (val) {
    switch (val) {
        case 0:
            val = '启用';
            break;
        case 1:
            val = '禁用';
            break;
    }
    return val;
}

export default {
    genderFilter,
    statusFilter
}