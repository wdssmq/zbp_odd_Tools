$(function() {
  // 自动选中监听
  $("input.auto-select, textarea.auto-select").mouseenter(function() {
    $(this).focus().select();
  });
  // 默认点击事件
  $("#newName-Btn").click(function() {

  });
});
