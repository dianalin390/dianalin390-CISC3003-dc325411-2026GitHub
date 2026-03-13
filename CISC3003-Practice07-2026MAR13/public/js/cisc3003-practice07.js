// 等待页面DOM完全加载后再执行所有逻辑，确保能正确获取到页面元素
document.addEventListener('DOMContentLoaded', function() {
    // ========== 功能1：高亮可聚焦字段 ==========
    // 获取所有带hilightable类的表单元素
    const hilightableFields = document.querySelectorAll('.hilightable');
    
    // 给每个可高亮字段绑定聚焦/失焦事件，切换高亮样式
    hilightableFields.forEach(function(field) {
        // 聚焦时添加高亮样式
        field.addEventListener('focus', function() {
            field.classList.add('highlight');
        });
        // 失焦时移除高亮样式
        field.addEventListener('blur', function() {
            field.classList.remove('highlight');
        });
    });

    // ========== 功能2：表单提交必填项校验 ==========
    // 获取表单元素、所有必填字段
    const artForm = document.querySelector('form');
    const requiredFields = document.querySelectorAll('.required');

    // 绑定表单提交事件
    artForm.addEventListener('submit', function(e) {
        let isFormInvalid = false;

        // 遍历所有必填项，校验是否为空
        requiredFields.forEach(function(field) {
            // 去除首尾空格后判断是否为空
            const fieldValue = field.value.trim();
            if (fieldValue === '') {
                field.classList.add('error'); // 为空添加错误样式
                isFormInvalid = true;
            } else {
                field.classList.remove('error'); // 有内容则移除错误样式
            }
        });

        // 表单校验不通过，阻止提交
        if (isFormInvalid) {
            e.preventDefault();
        }
    });

    // ========== 功能3：输入内容时自动清除错误样式 ==========
    requiredFields.forEach(function(field) {
        // 监听用户输入事件，内容变更后自动移除错误样式
        field.addEventListener('input', function() {
            if (field.value.trim() !== '') {
                field.classList.remove('error');
            }
        });
    });
});