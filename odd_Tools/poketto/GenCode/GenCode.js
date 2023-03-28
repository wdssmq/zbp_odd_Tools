$(function () {
  // 自动选中监听
  $("input.select, textarea.auto-select").mouseenter(function () {
    $(this).focus().select();
  });

  // 默认点击事件
  $("#GenCode-Btn").click(function () {
    const secret = $("#GenCode-Num").val();
    const cycle = $("#GenCode-Cycle").val();
    GenCode._init(secret, cycle);
    const { password } = GenCode._xnxfTotp();
    $("#GenCode-Out-01").val(password);

    // const begin = parseInt(secret);
    // const end = begin + 100;
    // for (let i = begin; i < end; i++) {
    //   const secret = i;
    //   // const days = $("#GenCode-Days").val();
    //   GenCode._init(secret, 30);
    //   const { password } = GenCode._xnxfTotp();
    //   console.log({ i, password }, "\n");
    // }
    // $("#GenCode-Num").val(end);

  });

  // -----------------

  const GenCode = {
    // 当前时间戳
    timestamp: Math.floor(Date.now() / 1000),
    // 密钥，只有数字
    secret: "123456",
    // 周期天数据
    cycle: 30,
    // 周期长度（以秒为单位）
    period: 86400,
    err: {
      code: 0,
      msg: "",
    },
    errMap: {
      0: "",
      1: "输入为空",
      2: "输入不是数字",
      3: "请输入至少 4 位数字",
    },
    _init(secret, cycle) {
      GenCode.secret = secret;
      GenCode.cycle = cycle;
      GenCode._updatePeriod();
    },
    _buildRlt(obj = {}) {
      return Object.assign({ err: GenCode.err }, obj);
    },
    _err(code = 0) {
      GenCode.err.code = code;
      GenCode.err.msg = GenCode.errMap[code];
    },
    _checkSecret() {
      if (!GenCode.secret) {
        GenCode._err(1);
        return false;
      }
      if (isNaN(GenCode.secret)) {
        GenCode._err(2);
        return false;
      }
      // if (GenCode.secret.length < 4) {
      //   GenCode._err(3);
      //   return false;
      // }
      GenCode._err(0);
      return true;
    },
    // 更新 period
    _updatePeriod() {
      GenCode.period = GenCode.days * 86400;
    },
    // // 一个基于 AI 代码的 TOTP 算法
    // _aiTotp() {
    //   // 检查密钥
    //   if (!GenCode._checkSecret()) {
    //     return GenCode._buildRlt({ password: GenCode.err.msg });
    //   }
    //   // 初始值
    //   const { timestamp, secret, period } = GenCode;
    //   const counter = Math.floor(timestamp / period); // 计数器取整数部分
    //   // 转换为数字
    //   let num = parseInt(secret);
    //   // 将密钥和计数器相加得到一个大数
    //   // num += counter;
    //   // 这一步我修改了一下，感觉还是不太能用
    //   num += counter + secret.toString();
    //   // 对这个大数进行一些操作以获取哈希值
    //   num *= num;
    //   num /= (counter + 1) * secret;
    //   // 获取前 4 位字符并将其映射到 A-Z 之间的 ASCII 码
    //   let password = "";
    //   for (let i = 0; i < 4; i++) {
    //     let index = ((num >> (i * 8)) & 255) % 26 + 65;
    //     password += String.fromCharCode(index);
    //   }
    //   // 返回结果
    //   return GenCode._buildRlt({ password });
    // },
    // 一个我自己写的 TOTP 函数
    _xnxfTotp() {
      // 检查密钥
      if (!GenCode._checkSecret()) {
        return GenCode._buildRlt({ password: GenCode.err.msg });
      }

      // 初始值
      const { timestamp, secret, cycle } = GenCode;

      // 转换为数字
      const num = parseInt(secret, 10);
      const days = timestamp / 86400;

      // 过程
      const arrCode = [
        num + cycle,
        Math.floor((num + days) / cycle),
      ];
      const strCode = arrCode.join("");
      const lenCode = strCode.length;
      const arrArgs = [
        Math.floor(lenCode / 4),
        lenCode % 4,
        // 剩余天数
        parseInt(cycle - (num + days) % cycle),
      ];
      const arrCodeRlt = [];
      let i = 0;
      while (arrCodeRlt.length < 4) {
        const strNum = strCode.substring(i, i + arrArgs[0] + arrArgs[1]);
        console.log(strCode, strNum);
        const strChar = ((input) => {
          const intNum = parseInt(input);
          return (intNum % 26 + 10).toString(36);
        })(strNum);
        arrCodeRlt.push(strChar);
        i += arrArgs[0];
      }
      // console.log("_genCode", { arrCode, strCode, lenCode, arrArgs, arrCodeRlt });
      return GenCode._buildRlt({
        password: [arrCodeRlt.join("").toUpperCase(), arrArgs[2]].join(" - ")
      });
    }
    // -----
  };

});
