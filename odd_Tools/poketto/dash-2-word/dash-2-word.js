$(function () {
  // Date 对象格式化为 "2021-12-06"
  function fnFormatDate(oDate) {
    let sDate = oDate.getDate();
    if (sDate < 10) {
      sDate = "0" + sDate.toString();
    }
    let sMonth = oDate.getMonth() + 1;
    if (sMonth < 10) {
      sMonth = "0" + sMonth;
    }
    const sYear = oDate.getFullYear();
    return sYear + "-" + sMonth + "-" + sDate;
  }
  // 实时获取时间
  const _curDate = () => { return new Date(); };
  // 自动选中监听
  $("input.select, textarea.auto-select").mouseenter(function () {
    $(this).focus().select();
  });
  // 默认点击事件
  $("#d2w-btn").click(function () {
    // 获取输入框内容
    const orgiWord = $("#d2w-InPut").val().trim();
    const dashWord = orgiWord.replace(/\s/g, "-");
    let strRlt = "";
    // 是否自动添加时间
    if ($("#d2w-date").is(":checked")) {
      const strDate = fnFormatDate(_curDate());
      strRlt = strDate + "-" + dashWord;
    }
    // 写入输出框
    $("#d2w-OutPut").val(strRlt);
  });
});
