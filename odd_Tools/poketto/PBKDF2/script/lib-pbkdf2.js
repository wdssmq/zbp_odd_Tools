class mz_PBKDF2 {
  name = "";
  password = "";
  opts = {};
  rlt = {
    bits: null,
    hexString: null,
  };

  /**
   * 对字符串进行编码
   *
   * @param str 待编码的字符串
   * @returns 编码后的Uint8Array类型数据
   */
  encode(str) {
    return new TextEncoder().encode(str);
  }

  /**
   * 构造函数
   *
   * @param name 用户名
   * @param password 密码
   * @param opts 可选配置项，默认为空对象
   * @param opts.name 密钥派生函数名称，默认为 "PBKDF2"
   * @param opts.hash 哈希算法名称，默认为 "SHA-256"
   * @param opts.salt 盐值，默认为空字符串的编码值
   * @param opts.iterations 迭代次数，默认为 1e7
   */
  constructor(name, password, opts = {}) {
    const defOpts = {
      name: "PBKDF2",
      hash: "SHA-256",
      salt: this.encode(""),
      iterations: 1e7,
      bitsLen: 256,
    };

    // 合并默认配置项
    this.opts = Object.assign(defOpts, opts);
    this.opts.salt = this.encode(name);

    this.name = name;
    this.password = password;
  }

  /**
   * 异步获取密钥
   *
   * @returns {Promise<CryptoKey>} 返回通过 PBKDF2 生成的密钥对象（Promise 对象）
   */
  async getKey() {
    const pwd = this.encode(this.password);
    return await crypto.subtle.importKey("raw", pwd, "PBKDF2", false, ["deriveBits"]);
  }

  /**
   * 从密钥中派生指定长度的位（bits）
   *
   * @param bits 派生位数的长度
   * @returns 派生的位（bits）
   * @async 异步函数
   */
  async getBits() {
    const key = await this.getKey();
    this.rlt.bits = await crypto.subtle.deriveBits(this.opts, key, this.opts.bitsLen);
    return this.rlt.bits;
  }

  /**
   * 获取最终提交给后端的密码
   *
   * @returns 返回经过MD5加密的密码字符串
   */
  async getHexString() {
    const bits = await this.getBits(); // 例如获取256位密钥
    // ArrayBuffer 转为字符串
    const hexString = Array.from(new Uint8Array(bits)).map((b) => b.toString(16).padStart(2, "0")).join("");
    this.rlt.hexString = hexString;
    return hexString;
  }

}
