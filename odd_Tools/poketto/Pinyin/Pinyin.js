$(function () {
  // 自动选中监听
  $("input.select").mouseenter(function () {
    $(this).focus().select();
  });
  // 默认点击事件
  $("#btn-Pinyin").click(function () {
    $("#PinyinOutPut").val("读取中");
    fnMain($("#defText").val(), $("#toPinyin").val(), (rltStr) => {
      $("#PinyinOutPut").val(rltStr);
    });
  });

  function fnMain(defText, strToPinyin, cb) {
    let ajaxurl = "https://helloacm.com/api/pinyin/?cached&s=-text-&t=0";
    ajaxurl = ajaxurl.replace(/-text-/, strToPinyin);
    $.getJSON(ajaxurl, function (data) {
      let arrText = [],
        arrPinyin = [];
      console.log(data);
      arrPinyin = data.result;
      for (let index = 0; index < defText.length; index++) {
        const element = defText[index];
        arrText.push(element);
        if (arrPinyin[index]) {
          arrText.push("(" + arrPinyin[index] + ")");
        }
      }
      cb(arrText.join(""));
    });
  }
});
