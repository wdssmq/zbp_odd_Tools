$(function () {
  // 自动选中监听，包括未来新增的元素
  $(document).on("mouseenter", "input.select, textarea.auto-select", function () {
    $(this).focus().select();
  });

  $(".odd-submit")
    .click(function () {
      const jsonUrl = $("#jsonUrl").val();
      fnAjax(jsonUrl);
      // console.log(jsonUrl);
    })
    .click();

  function fnAjax(jsonUrl) {
    $.getJSON(jsonUrl, function (data) {
      const arrBadge = fnGenRlt(data);
      // console.log(arrBadge);
      const { html, list } = fnBuildHTML(arrBadge);
      $(".odd-rlt").val(html);
      $(".odd-rlt-view").html(html);
      $(".odd-rlt-list").html(list);
      fnCollapse(".collapse-btn", ".collapse-content");
      // console.log(data);
    });
  }

  // 转义 HTML
  function fnEscapeHTML(html) {
    return html.replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
  };

  function fnBuildHTML(arrBadge) {
    const tplListItem = `<div>
      <columns class="is-flex is-align-items-center list-item-title">
        <span class="column">#view#</span>
        <span class="column collapse-btn button is-small" data-target="#list-item-#index#">展开 #index#</span>
        <span class="column"></span>
      </columns>
      <div class="collapse-content" id="list-item-#index#">
        <p class="control">
          <input class="input select is-small" type="text" value="#value#" />
        </p>
        <!-- markdown -->
        <p class="control">
          <input class="input select is-small" type="text" value="#markdown#" />
        </p>
      </div>
    </div>`;
    let rltHTML = "", rltList = "";
    rltHTML += "<p>\n";
    arrBadge.forEach((item,i) => {
      const { img, alt: curAlt, url: curUrl } = item;
      const curImg = `<img src="${img}" alt="${curAlt}" />`;
      rltHTML += `<!-- ${curAlt} -->\n`;
      let curView = "";
      if (curUrl) {
        curView = `<a target="_blank" title="${curAlt}" href="${curUrl}">${curImg}</a>`;
      } else {
        curView = curImg;
      }
      // console.log(curView);
      rltHTML += curView;
      rltHTML += "\n";
      // 构造单个图标查看
      const curImgMD = `![${curAlt}](${img})`;
      const curMD = curUrl ? `[${curImgMD}](${curUrl})` : curImgMD;
      const curListItem = tplListItem
        .replace(/#index#/g, i)
        .replace(/#view#/g, curView)
        .replace(/#value#/g, fnEscapeHTML(curView))
        .replace(/#markdown#/g, `${curMD}`);
      rltList += curListItem;
      // console.log(curListItem);
    });
    rltHTML += "</p>";
    return {
      html: rltHTML,
      list: rltList,
    };
  }


  function fnGenRlt(data) {
    const dataRlt = [];
    if (data.shields) {
      data.shields.forEach((item) => {
        // 徽章图片地址
        const imgBase = "https://img.shields.io/badge/-label-|-msg-|-color-";
        let curImg = item.imgBase ? item.imgBase : imgBase;
        for (const key in item) {
          if (Object.hasOwnProperty.call(item, key)) {
            const curEl = item[key];
            curImg = curImg.replace(`-${key}-`, encodeURIComponent(curEl));
          }
        }
        // curImg = curImg.replace(/-[^-]+-/g, "");
        curImg = curImg.replace(/\|/g, "-");

        // 描述文本信息
        const curAlt = `${item.label}-${item.msg}`.replace(/^-/g, "");

        // 点击链接地址
        let curUrl = item.urlBase ? item.urlBase : item.url;
        if (item.urlBase) {
          for (const key in item) {
            if (Object.hasOwnProperty.call(item, key)) {
              const curEl = item[key];
              curUrl = curUrl.replace(`-${key}-`, encodeURIComponent(curEl));
            }
          }
        }

        // 生成结果
        const curRlt = {
          label: item.label,
          msg: item.msg,
          alt: curAlt,
          img: curImg,
          url: curUrl,
        };
        dataRlt.push(curRlt);
      });
    }
    return dataRlt;
  }
});
