$(function () {
  $(".odd-submit")
    .click(function () {
      const jsonUrl = $("#jsonUrl").val();
      fnAjax(jsonUrl);
      console.log(jsonUrl);
    })
    .click();

  function fnAjax(jsonUrl) {
    $.getJSON(jsonUrl, function (data) {
      const html = fnGenRlt(data);
      $(".odd-rlt").val(html);
      $(".odd-rlt-view").html(html);
      console.log(data);
    });
  }
  function fnGenRlt(data) {
    let strRlt = "";
    if (data.shields) {
      strRlt += "<p>";
      data.shields.forEach((item) => {
        let imgBase = "https://img.shields.io/badge/-label-|-msg-|-color-";
        if (item.imgBase) {
          imgBase = item.imgBase;
        }
        for (const key in item) {
          if (Object.hasOwnProperty.call(item, key)) {
            const curEl = item[key];
            imgBase = imgBase.replace(`-${key}-`, encodeURIComponent(curEl));
          }
        }
        // imgBase = imgBase.replace(/-[^-]+-/g, "");
        imgBase = imgBase.replace(/\|/g, "-");
        const alt = `${item.label}-${item.msg}`.replace(/^-/g,"");
        const curImg = `<img src="${imgBase}" title="${alt}" alt="${alt}">`;
        // console.log(curImg);
        let urlBase = item.urlBase ? item.urlBase : item.url;
        if (item.urlBase) {
          for (const key in item) {
            if (Object.hasOwnProperty.call(item, key)) {
              const curEl = item[key];
              urlBase = urlBase.replace(`-${key}-`, encodeURIComponent(curEl));
            }
          }
        }
        if (urlBase) {
          strRlt += `<a target="_blank" title="${item.label}-${item.msg}" href="${urlBase}">${curImg}</a>`;
        } else {
          strRlt += curImg;
        }
        strRlt += " ";
      });
      strRlt += "</p>";
    }
    return strRlt;
  }
});
