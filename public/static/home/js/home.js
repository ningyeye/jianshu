window.onload = function () {
    var E = window.wangEditor;
    var editor = new E(document.getElementById('editor'));
    var content = $('#content');
    // 自定义菜单配置
    editor.customConfig.menus = ['head', // 标题
        'bold', // 粗体
        'fontSize', // 字号
        'fontName', // 字体
        'foreColor', // 文字颜色
        'backColor', // 背景颜色
        'link', // 插入链接
        'list', // 列表
        'justify', // 对齐方式
        'quote', // 引用
        'emoticon', // 表情
        'image', // 插入图片
        'table', // 表格
        'code', // 插入代码
        'undo', // 撤销
        'redo' // 重复
    ];

    editor.customConfig.customUploadImg = function (files, insert) {
        var obj = new FormData();
        // files 是 input 中选中的文件列表
        for (var i = 0; i < files.length; i++) {
            obj.append("files[" + i + "]", files[i]);
        }
        //obj.append("file", files[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/news/img/upload",
            data: obj,
            dataType: 'json',
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.status == 0) {
                    for (var j = 0; j < result.res.length; j++) {
                        insert(result.res[j].path);
                    }
                }
                //insert(result.path);// insert 是获取图片 url 后，图片插入到编辑器的方法 将图片插入到编辑器中
            }
        });
    };
    editor.customConfig.onchange = function (html) {
        // 监控变化，同步更新到 textarea
        content.val(html)
    };
    editor.create();
    // 初始化 textarea 的值
    editor.txt.html(content.val());

};