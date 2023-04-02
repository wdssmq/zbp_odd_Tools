$(function () {
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
      const html = fnBuildHTML(arrBadge);
      $(".odd-rlt").val(html);
      $(".odd-rlt-view").html(html);
      // console.log(data);
    });
  }

  function fnBuildHTML(arrBadge) {
    let strRlt = "";
    strRlt += "<p>\n";
    arrBadge.forEach((item) => {
      const { img, alt: curAlt, url: curUrl } = item;
      const curImg = `<img src="${img}" alt="${curAlt}" />`;
      strRlt += `<!-- ${curAlt} -->\n`;
      if (curUrl) {
        strRlt += `<a target="_blank" title="${curAlt}" href="${curUrl}">${curImg}</a>`;
      } else {
        strRlt += curImg;
      }
      strRlt += "\n";
    });
    strRlt += "</p>";
    return strRlt;
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
