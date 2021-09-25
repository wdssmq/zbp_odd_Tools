$(function () {
  // 自动选中监听
  $("input.select").mouseenter(function () {
    $(this).focus().select();
  });
  // 默认点击事件
  $("#btn-newName").click(function () {

  });
});
