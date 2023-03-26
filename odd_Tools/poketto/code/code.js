$(function () {
  $(".odd-submit")
    .click(function () {
      const jsonUrl = $("#jsonUrl").val();
      console.log(jsonUrl);
      fnAjax(jsonUrl);
    })
    .click();

  function fnAjax(jsonUrl) {
    $.getJSON(jsonUrl, function (data) {
      console.log(data);
      const html = fnGenRlt(data);
      $(".odd-rlt").val(html);
    });
  }

  function fnGenRlt(object) {
    let strRlt = "";
    for (const key in object) {
      if (Object.hasOwnProperty.call(object, key)) {
        const curEl = object[key];
        const cruArr = fnGenHash(curEl);
        strRlt += cruArr.join("");
        strRlt += "\n\n";
      }
    }
    return strRlt;
  }

  function fnGenHash(inputStr) {
    // 初始字符
    const baseCode = inputStr.replace(/\D/g, "");
    // 获取地址 hash
    let salt = `${location.hash}`.replace("#", "");

    if (salt !== "") {
      // 不为空则存入 ls
      localStorage.code = salt;
    } else if (localStorage.code) {
      // 或者从 ls 读取
      salt = localStorage.code;
    }

    if (!salt) {
      salt = 1024;
    }

    salt = parseInt(salt, 10);

    const date = new Date();
    const year = parseInt(date.getFullYear());

    const m = [salt + year, salt + parseInt(baseCode)].join("");
    const n = parseInt(m).toString(36);
    const n_len = n.length;

    const rlt = { cache: [], data: [] };
    rlt.cache.push([m, n, n_len].join(" , "));

    const forStop = salt.toString().length < n_len ? salt.toString().length : n_len;
    for (let index = 0; index < forStop; index++) {
      let curInt = n.charCodeAt(index) + n.charCodeAt(n_len - index - 1) + 71;
      rlt.cache.push(
        [curInt, n.charCodeAt(index), n.charCodeAt(n_len - index - 1)].join(
          " , ",
        ),
      );
      curInt = (curInt % 26) + 10;
      rlt.data.push(curInt.toString(36));
    }
    return [rlt.cache.join("\n"), "\n", rlt.data.join("")];
  }
});
