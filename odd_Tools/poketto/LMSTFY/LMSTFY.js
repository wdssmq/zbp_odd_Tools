$(function () {
  const curTitle = document.title;
  const curSearch = window.location.search;
  const curUrl = window.location.href.replace(curSearch, "").replace(/\/$/, '');
  // 如果 curSearch 不为空
  if (curSearch) {
    let strSearch = curSearch.replace(/^\?/, "");
    strSearch = decodeURI(strSearch);
    $("#LMSTFY-InPut").val(strSearch);
    $("#LMSTFY-InPut").data("search", strSearch);
    $("#LMSTFY-btn-search").removeClass("is-hidden");
    $(".js-tips").text("← 好像有人帮你生成了一个搜索，点击第二个按钮可直接查看；");
  }
  // 自动选中监听
  $("input.select, textarea.auto-select").mouseenter(function () {
    $(this).focus().select();
  });
  // 默认点击事件
  $("#LMSTFY-btn").click(function () {
    const strQuery = $("#LMSTFY-InPut").val();
    if (strQuery.length === 0) {
      $("#LMSTFY-InPut").focus();
      return;
    }
    $(".js-OutPut-Content").removeClass("is-hidden");
    $("#LMSTFY-btn-search").removeClass("is-hidden");
    if (!curSearch) {
      $(".js-tips").text("← 点击第二个按钮查看搜索；");
    } else if ($("#LMSTFY-InPut").data("search") !== strQuery) {
      $(".js-tips").text("← 预定搜索内容已修改，点击第二个按钮查看；");
    }

    const codeQuery = encodeURI(strQuery);

    $("#LMSTFY-OutPut").val(`${curTitle}\n${curUrl}/?${codeQuery}`);
  });
  // 跳转到搜索页面
  $("#LMSTFY-btn-search").click(function () {
    const strQuery = $("#LMSTFY-InPut").val();
    if (strQuery.length === 0) {
      $("#LMSTFY-InPut").focus();
      return;
    }
    const $radio = $("input[name='LMSTFY-Engine']:checked");
    const tplUrl = $radio.data("url");
    const dstUrl = tplUrl.replace("{query}", strQuery);
    window.open(dstUrl);
  });
});
