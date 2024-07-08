$(function() {
  // 自动选中监听
  $("input.select, textarea.auto-select").mouseenter(function() {
    $(this).focus().select();
  });

  // 计时器
  let timer = null;
  let time = 0;
  function timerStart() {
    time = 0;
    timer = setInterval(function() {
      $(".js-timer").text(`${++time} 秒`);
    }, 1000);
  }

  // 循环次数识别，文本转数字
  const fnGetNumber = function(str) {
    let num = null;
    switch (str) {
      case "1e6":
        num = 1e6;
        break;
      case "3e6":
        num = 3e6;
        break;
      case "5e6":
        num = 5e6;
        break;
      case "1e7":
        num = 1e7;
        break;
      default:
        num = 1e6;
        break;
    }
    return num;
  };

  // 默认点击事件
  $("#PBKDF2-Btn").click(async function() {
    const username = $("#PBKDF2-username").val();
    const password = $("#PBKDF2-password").val();
    // 循环次数
    const iterations = fnGetNumber($("#PBKDF2-iterations").val());
    console.log(iterations);
    // 计时器
    timerStart();
    // 清空结果
    $("#PBKDF2-HexStr").val("生成中...");
    const o_PBKDF2 = new mz_PBKDF2 (username, password, { iterations });
    const HexStr = await o_PBKDF2.getHexString();
    $("#PBKDF2-HexStr").val(HexStr);
    console.log(o_PBKDF2.rlt);
    clearInterval(timer);
  });
});
