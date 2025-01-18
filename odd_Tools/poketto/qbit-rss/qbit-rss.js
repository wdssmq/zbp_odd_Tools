$(function() {
  // 自动选中监听
  $("input.auto-select, textarea.auto-select").mouseenter(function() {
    $(this).focus().select();
  });

  // 生成配置的函数
  function generateConfig() {
    const feed = $("#qbit-rss-Feed").val().trim();
    const category = $("#qbit-rss-Category").val().trim();
    const filter = $("#qbit-rss-Filter").val().trim();
    const useRegex = $("#qbit-rss-Regex").prop("checked");

    // 验证输入
    if (!feed || !category || !filter) {
      alert("请填写所有必填字段");
      return;
    }

    // 生成规则名称（使用时间戳和分类名称）
    const ruleName = `${new Date().getFullYear()}-${String(new Date().getMonth() + 1).padStart(2, '0')}-${category}`;

    // 构建配置对象
    const config = {
      [ruleName]: {
        affectedFeeds: [feed],
        assignedCategory: category,
        mustContain: filter,
        useRegex: useRegex,
        torrentParams: {
          category: category
        }
      }
    };

    // 格式化 JSON 并显示
    $("#qbit-rss-OutPut").val(JSON.stringify(config, null, 4));
  }

  // 下载配置文件
  function downloadConfig() {
    const content = $("#qbit-rss-OutPut").val();
    if (!content) {
      alert("请先生成配置");
      return;
    }

    // 创建 Blob 对象
    const blob = new Blob([content], { type: "application/json" });

    // 创建下载链接
    const url = window.URL.createObjectURL(blob);
    const category = $("#qbit-rss-Category").val().trim();
    const fileName = `qbit-rss-${category}.json`;

    // 创建临时下载链接并触发下载
    const a = document.createElement("a");
    a.href = url;
    a.download = fileName;
    document.body.appendChild(a);
    a.click();

    // 清理
    window.URL.revokeObjectURL(url);
    document.body.removeChild(a);
  }

  // 绑定生成按钮点击事件
  $("#qbit-rss-Btn").click(generateConfig);

  // 绑定下载按钮点击事件
  $("#qbit-rss-Download").click(downloadConfig);

  // 绑定输入框回车事件
  $("input.select").keypress(function(e) {
    if (e.which === 13) {
      generateConfig();
    }
  });
});
