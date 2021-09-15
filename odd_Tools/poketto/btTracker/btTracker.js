$(function () {
  // 自动选中监听
  $("#output").mouseenter(function () {
    $(this).focus().select();
  });

  $("#btn-sole").click(function () {
    fnSole();
    $("#btn-copy").text("复制");
  });

  let clipboard = new ClipboardJS("#btn-copy");
  clipboard.on("success", function (e) {
    e.trigger.innerHTML = "已复制";
  });

  function fnGet(url, callback) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function (e) {
      if (this.status == 200 || this.status == 304) {
        callback(this.responseText);
        fnSole();
      } else {
        console.error(this.status);
      }
    };
    xmlhttp.onerror = function (e) {
      console.error(e);
      console.error(this);
    };
    xmlhttp.open("GET", url, true);
    //xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send(null);
  }
  document.getElementById("input").value = "";

  fnGet(
    "https://raw.githubusercontent.com/ngosang/trackerslist/master/trackers_best_ip.txt",
    function (data) {
      document.getElementById("input").value += data;
    }
  );
  fnGet(
    "https://raw.githubusercontent.com/ngosang/trackerslist/master/trackers_best.txt",
    function (data) {
      document.getElementById("input").value += data;
    }
  );
  fnGet("https://newtrackon.com/api/stable", function (data) {
    document.getElementById("input").value += data;
  });

  // 用于生成种子内压缩格式的 tracker 信息
  function fnSplice() {
    const input = document.getElementById("input").value;
    const arrUrls = input.split(/[\r\n]{1,}/);
    let rltStr;
    for (x in arrUrls) {
      if (x == 0) {
        rltStr = "ll" + arrUrls[x].length + ":" + arrUrls[x];
      } else if (rltStr.indexOf(arrUrls[x]) == -1) {
        rltStr = rltStr + "el" + arrUrls[x].length + ":" + arrUrls[x];
      }
    }
    rltStr = rltStr + "ee";
    document.getElementById("output").value = rltStr;
    document.getElementById("output").style.height = 1 + "px";
    document.getElementById("output").style.height =
      document.getElementById("output").scrollHeight + 10 + "px";
    document.getElementById("output").select();
    return false;
  }
  // 去重
  function fnSole() {
    const input = document.getElementById("input").value;
    const arrUrls = Array.from(new Set(input.split(/[\r\n]{1,}/)));
    const rltUrlStr = arrUrls.join("\n\n").trim();
    document.getElementById("output").value = rltUrlStr;
    // document.getElementById("output").style.height =   document.getElementById("output").scrollHeight + "px";
    document.getElementById("output").select();
    return false;
  }
});
