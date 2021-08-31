$(function () {
  // 自动选中监听
  $("#inpUrl,#outUrl").mouseenter(function () {
    $(this).focus().select();
  });
  // 解
  $(".odd-decode").click(function () {
    const inpUrl = $("#inpUrl").val();
    $("#outUrl").val(fnDeCode(inpUrl));
  });
  // 解
  function fnDeCode(strIn) {
    let strOut = strIn;
    if (strIn !== null && strIn !== "") {
      let reg = /[\u4e00-\u9fa5]/g;
      strOut = strIn.replace(reg, "");
    }
    return strOut;
  }
  // 加
  $(".odd-encode").click(function () {
    const inpUrl = $("#inpUrl").val();
    $("#outUrl").val(fnEnCode(inpUrl));
  });
  // 加
  function fnEnCode(strIn) {
    // 插入文字信息
    const map = "删除插入的汉字".split("");
    const len = map.length;
    // 切分输入
    const arrIn = strIn.split("");
    // 生成新数组
    const arrOut = arrIn.map((el, i) => {
      if (i == 0 || i % 4 !== 0) {
        return el;
      }
      const serID = (i / 4 - 1) % len;
      return `${el}${map[serID]}`;
    });
    // console.log(map, arrIn, arrOut);
    return arrOut.join("");
  }
});
