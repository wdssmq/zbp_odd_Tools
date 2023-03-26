/* global html2canvas */

$(function () {
  // 自动选中监听
  $("input.select, textarea.auto-select").mouseenter(function () {
    $(this).focus().select();
  });

  // 为元素备份属性，在需要的时候恢复
  $.fn._text = function (text = "") {
    const dataText = $(this).data("text");
    if (!dataText) {
      $(this).data("text", $(this).text());
    }
    if (text) {
      $(this).text(text);
    } else {
      $(this).text(dataText);
    }
  };

  // 默认点击事件
  $("#ImgPuzzle-Btn").click(function () {
    // 切割图片
    fnCutImg(ImgPuzzle.$cut);
    // 打乱顺序
    fnRandom(ImgPuzzle.$cut);
    // 合并输出
    fnMergeImg(ImgPuzzle.$cut, $("#ImgPuzzle-Down"));
  });

  // // 绑定下载事件
  // $("#ImgPuzzle-Down").click(function () {
  // });

  // 还原图片
  $("#ImgPuzzle-Reset").click(function () {
    // 判断是否选择了图片
    if (!ImgPuzzle._check()) return;
    const indexCode = prompt("请输入还原码：");
    // 仅将源图切割
    fnCutImg(ImgPuzzle.$cut);
    // 使用 indexCode 还原图片
    fnReset(ImgPuzzle.$cut, indexCode);
    // 合并输出
    fnMergeImg(ImgPuzzle.$cut, $("#ImgPuzzle-Down"));
  });

  // 各种初始信息
  const ImgPuzzle = {
    // 文件选择
    $file: $("#ImgPuzzle-InPut"),
    // 图片预览
    $view: $("#ImgPuzzle-View"),
    // 图片切割
    $cut: $("#ImgPuzzle-Cut"),
    // 提示信息
    $tips: $("#ImgPuzzle-Tips"),
    // 图片数据
    imgInfo: {
      width: 0,
      height: 0,
      data: null,
      name: "",
    },
    indexCode: "",
    // 提示信息
    tips: {
      "no-cut": "请先切割图片",
      "no-img": "请先选择图片",
      "err-type": "请选择「图片」文件",
    },
    _tips(arg, keep = false) {
      let msg;
      // 判断是否有对应的提示信息
      if (ImgPuzzle.tips[arg]) {
        msg = ImgPuzzle.tips[arg];
      } else {
        msg = arg;
      }
      ImgPuzzle.$tips.text(msg);
      // 如果设置了 keep 则跳过
      if (keep) return;
      // 3s 后清空提示信息
      setTimeout(() => {
        ImgPuzzle.$tips.text("");
      }, 3000);
    },
    _log() {
      console.log(ImgPuzzle.indexCode);
    },
    status: {
      pickImg: false,
      isCut: false,
      isRandom: false,
    },
    _check(step = "pick") {
      if (!ImgPuzzle.status.pickImg) {
        ImgPuzzle.$tips.text(ImgPuzzle.tips["no-img"]);
        return false;
      }
      if (step === "pick") return true;
      if (!ImgPuzzle.status.isCut) {
        ImgPuzzle.$tips.text(ImgPuzzle.tips["no-cut"]);
        return false;
      }
      return true;
    },
    _init() {
      // 图片预览区域占位
      ImgPuzzle.$view.css({
        // "width": "300px",
        "height": "300px",
        "border": "1px dashed #ccc",
      });
      // ImgPuzzle.$view 实际宽度
      ImgPuzzle.imgInfo.maxWidth = ImgPuzzle.$view.width();
      ImgPuzzle._tips(ImgPuzzle.imgInfo.maxWidth);
    },
  };

  ImgPuzzle._init();


  // ImgPuzzle-InPut 内容改变时
  ImgPuzzle.$file.change(function () {
    fnViewImg(this, ImgPuzzle.$view);
  });

  // 图片预览封装
  const fnViewImg = ($input, $view) => {
    // 检查宽和高
    const checkWH = (w, h) => {
      if (w <= ImgPuzzle.imgInfo.maxWidth) {
        return { width: w, height: h };
      }
      const scale = ImgPuzzle.imgInfo.maxWidth / w;
      return { width: ImgPuzzle.imgInfo.maxWidth, height: h * scale };
    };
    const file = $input.files[0];
    // 检查文件是否为图像类型
    if (!/^image\//.test(file.type)) {
      ImgPuzzle._tips("err-type");
      return;
    }
    // 获取文件名
    ImgPuzzle.imgInfo.name = file.name;
    // 创建 FileReader 对象并读取文件数据
    const reader = new FileReader();
    // 读取成功后的回调函数
    reader.onloadend = function () {
      // 获取图像数据
      const img = new Image();
      img.onload = () => {
        // 获取图像宽高
        const { width, height } = checkWH(img.width, img.height);
        // 设置图像预览区域宽高
        $view.css("width", `${width}px`);
        $view.css("height", `${height}px`);
        ImgPuzzle.imgInfo.width = width;
        ImgPuzzle.imgInfo.height = height;
      };
      img.src = ImgPuzzle.imgInfo.data = reader.result;
      // 将图像数据作为背景设置到 div 元素中进行预览
      $view.css("background-image", `url(${reader.result})`);
      $view.css("background-size", "cover");
      // 清空 input 文件选择框，以便用户可以选择同一张图片进行重新预览
      $input.value = "";
      ImgPuzzle.status.pickImg = true;
    };
    // 读取文件数据
    reader.readAsDataURL(file);
  };

  // 将图片切割成 3 * 3 的小块
  const fnCutImg = ($cut, m = 3, n = 3) => {
    // 判断是否选择了图片
    if (!ImgPuzzle._check()) return;
    // 根据 dataset 判断是否已经切割过
    if ($cut.data("lst-cut-name") === ImgPuzzle.imgInfo.name) return;
    // 设置 dataset
    $cut.data("lst-cut-name", ImgPuzzle.imgInfo.name);
    // 获取图片宽高
    const { width, height } = ImgPuzzle.imgInfo;
    // bulma 设置 flex 和 换行
    $cut.addClass("is-flex is-flex-wrap-wrap");
    // 设置 ImgPuzzle-Cut 的宽高
    $cut.css({
      "width": `${width}px`,
      "height": `${height}px`,
    });
    // 按顺序编号
    let index = 0;
    // 清空 ImgPuzzle-Cut
    $cut.empty();
    // 生成 m * n 个 view-cut
    for (let i = 0; i < m; i++) {
      for (let j = 0; j < n; j++) {
        index += 1;
        // 创建一个 view-cut 的 div 元素
        const $viewCut = $(`<div data-index="${index}" class="view-cut"></div>`);
        // 设置 view-cut 的宽高
        $viewCut.css("width", `${width / m}px`);
        $viewCut.css("height", `${height / n}px`);
        // 设置 view-cut 的背景图
        $viewCut.css("background-image", `url(${ImgPuzzle.imgInfo.data})`);
        $viewCut.css("background-size", `${width}px ${height}px`);
        $viewCut.css("background-position", `-${width / m * j}px -${height / m * i}px`);
        // 将 view-cut 添加到 ImgPuzzle-Cut 中
        $cut.append($viewCut);
      }
    }
    // 设置切割状态
    ImgPuzzle.status.isCut = true;
  };

  // 打乱顺序
  const fnRandom = ($cut) => {
    // 判断是否已经切割
    if (!ImgPuzzle._check("cut")) return;
    // 获取 ImgPuzzle-Cut 中的 view-cut
    const $viewCuts = $cut.children(".view-cut");
    // 将 view-cut 随机排序
    const $viewCutsRandom = $viewCuts.sort(() => Math.random() - 0.5);
    // 将 view-cut 重新添加到 ImgPuzzle-Cut 中
    $cut.empty();
    $cut.append($viewCutsRandom);
    // 重置 indexCode
    ImgPuzzle.indexCode = "";
    // 重新拼接 indexCode
    $viewCutsRandom.each((index, item) => {
      // ImgPuzzle.indexCode += item.classList[1].slice(-1);
      ImgPuzzle.indexCode += $(item).data("index").toString();
    });
    ImgPuzzle._log();
    ImgPuzzle._tips(`当前还原码是：${ImgPuzzle.indexCode}`, true);
    // 设置随机状态
    ImgPuzzle.status.isRandom = true;
  };

  // 切割结果合并输出并下载
  const fnMergeImg = ($cut, $btn) => {
    // 判断是否已经切割
    if (!ImgPuzzle._check("cut")) return;
    // 禁用下载按钮
    $btn.attr("disabled", true);
    // 请稍等的提示
    $btn._text("请稍等...");
    html2canvas($cut[0]).then((canvas) => {
      // 拼接文件名和 indexCode
      const dlName = `${ImgPuzzle.imgInfo.name.slice(0, -4)}-${ImgPuzzle.indexCode}.png`;
      // 设置下载按钮的 href
      $btn.attr("href", canvas.toDataURL("image/png"));
      // 设置下载按钮的 download
      $btn.attr("download", dlName);
      // 恢复下载按钮
      $btn.removeAttr("disabled");
      // 恢复下载按钮的文本
      $btn._text();
    });
  };

  // 还原
  const fnReset = ($cut, indexCode) => {
    // 判断是否已经切割
    if (!ImgPuzzle._check("cut")) return;
    // 获取 ImgPuzzle-Cut 中的 view-cut
    const $viewCuts = $cut.children(".view-cut");
    // 遍历 view-cut，使用输入的 indexCode 覆盖原有的 index
    $viewCuts.each((index, item) => {
      // 获取当前 view-cut 的 index
      const curIndex = $(item).data("index");
      // 获取输入的 indexCode 的第 index 位
      const newIndex = indexCode.charAt(curIndex - 1);
      // 将当前 view-cut 的 index 覆盖为输入的 indexCode 的第 index 位
      $(item).data("index", newIndex);
    });
    // 将 view-cut 排序
    const $viewCutsSort = $viewCuts.sort((a, b) => {
      return $(a).data("index") - $(b).data("index");
    });
    // 将 view-cut 重新添加到 ImgPuzzle-Cut 中
    $cut.empty();
    $cut.append($viewCutsSort);
  };

});
