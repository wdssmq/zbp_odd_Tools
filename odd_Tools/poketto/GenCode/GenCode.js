/* global lsObj */

$(function () {
  // 自动选中监听
  $("input.select, textarea.auto-select").mouseenter(function () {
    $(this).focus().select();
  });

  // 封装生成函数
  const fnGenCode = () => {
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
  };

  // 默认点击事件
  $("#GenCode-Save").click(() => {
    fnGenCode();
    GenCode._saveHis();
  });

  // 自动触发
  $("#GenCode-Num, #GenCode-Cycle").on("input", fnGenCode);

  // 删除历史
  $("#GenCode-Del").click(function () {
    lsObj.setItem("GenCode-History", []);
    window.location.reload();
  });

  // -----------------

  const GenCode = {
    // 当前时间戳秒数
    ts_s: Math.floor(Date.now() / 1000),
    // 时间戳转换成天数
    ts_d: 1234,
    // 密钥，只有数字
    secret: "123456",
    // 周期天数
    period_d: 1,
    // 周期长度（以秒为单位）
    period_s: 864000,
    // 生成的密码
    password: null,
    // 历史
    history: [],
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
      GenCode.period_d = cycle;
      GenCode.period_s = cycle * 86400;
      GenCode.ts_d = Math.floor(GenCode.ts_s / 86400);
      return GenCode;
    },
    _buildRlt(obj = {}) {
      // 判断 obj 是否有 password 属性
      if (obj.password) {
        GenCode.password = obj.password;
      }
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
      GenCode.period_d = parseInt(GenCode.period_d);
      GenCode.secret = parseInt(GenCode.secret);
      return true;
    },
    // 一个我自己写的 TOTP 函数
    _xnxfTotp() {
      // 检查密钥
      if (!GenCode._checkSecret()) {
        return GenCode._buildRlt({ password: GenCode.err.msg });
      }

      // 初始值
      const { secret, period_d, ts_d } = GenCode;

      // 变量赋值
      const num = secret;
      const days = ts_d;
      const cycle = period_d;
      // 第几个周期
      const _counter = adjDays => Math.floor(adjDays / cycle);
      // 剩余天数
      const remain = cycle - (num + days) % cycle;

      // 过程
      const arrCode = [
        num + cycle,
        _counter(num + days),
      ];
      const strCode = arrCode.join("");
      const lenCode = strCode.length;
      const arrArgs = [
        Math.floor(lenCode / 4),
        lenCode % 4,
      ];
      // console.log(133, "|", JSON.stringify({ arrCode, strCode, lenCode, arrArgs }));
      // console.log(strCode);
      const arrCodeRlt = [];
      let i = 0;
      while (arrCodeRlt.length < 4) {
        const strNum = strCode.substring(i, i + arrArgs[0] + arrArgs[1]);
        // console.log(134, "|", strCode, strNum);
        const strChar = ((input) => {
          const intNum = parseInt(input);
          return (intNum % 26 + 10).toString(36);
        })(strNum);
        arrCodeRlt.push(strChar);
        i += arrArgs[0];
      }
      // console.log("_genCode", { arrCode, strCode, lenCode, arrArgs, arrCodeRlt });
      return GenCode._buildRlt({
        password: arrCodeRlt.join("").toUpperCase(),
        remain,
      });
    },
    _saveHis() {
      const { secret, period_d: cycle, password, history } = GenCode;
      // 保存历史数据到 localStorage
      if (GenCode.err.code === 0 && JSON.stringify(history).indexOf(password) === -1) {
        history.push({ secret, cycle, password });
        lsObj.setItem("GenCode-History", history);
      }
    },
    _loadHis(def = []) {
      GenCode.history = lsObj.getItem("GenCode-History", def);
      GenCode.history = GenCode.history.map((item) => {
        const { secret, cycle } = item;
        // 使用 secret 和 cycle 重新生成 password 和 remain
        const { password, remain } = GenCode._init(secret, cycle)._xnxfTotp();
        return { secret, cycle, password, remain };
      });
      // 按 remain 值降序
      GenCode.history = GenCode.history.sort((a, b) => b.remain - a.remain);
      // console.log(GenCode.history);
    },
    // -----
  };

  GenCode._loadHis();

});
