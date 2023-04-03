// localStorage 封装
// eslint-disable-next-line no-unused-vars
const lsObj = {
  setItem: function (key, value) {
    localStorage.setItem(key, JSON.stringify(value));
  },
  getItem: function (key, def = "") {
    const item = localStorage.getItem(key);
    if (item) {
      return JSON.parse(item);
    }
    return def;
  },
};

// 面板折叠封装
// eslint-disable-next-line no-unused-vars
const fnCollapse = function (btn, content) {
  // 随机生成一个 group id，不用 substr
  const groupID = Math.random().toString(36).slice(2);
  const $$btn = document.querySelectorAll(btn);
  const $$content = document.querySelectorAll(content);
  $$btn.forEach(($btn) => {
    // 为每个按钮添加 group id
    $btn.dataset.group = groupID;
    $btn.addEventListener("click", function () {
      const target = this.dataset.target;
      console.log(target);
      // 关闭其他面板
      $$content.forEach(($content) => {
        if (target.indexOf($content.id) === -1 && $content.dataset.group === groupID) {
          console.log($content.id);
          $content.classList.remove("is-active");
        }
      });
      const $target = document.querySelector(target);
      $target.classList.toggle("is-active");
    });
  });
  $$content.forEach(($content) => {
    $content.dataset.group = groupID;
  });
};
