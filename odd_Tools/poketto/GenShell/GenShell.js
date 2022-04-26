$(function () {
  // 自动选中监听
  $("input.select, textarea.auto-select").mouseenter(function () {
    $(this).focus().select();
  });

  // 表单模板
  const tpl = `
<div class="field is-horizontal">
  <div class="field-label is-normal">
    {{left}}
  </div>
  <div class="field-body">
    <div class="field">
      <div class="control">
         {{right}}
      </div>
    </div>
  </div>
</div><!-- / .field -->
`;

  // 生成表单
  function fnGenHTML(app) {
    let head = tpl,
      body = tpl,
      foot = tpl;
    // 表单说
    head = head.replace(/{{left}}/g, "参数设置");
    body = body.replace(/{{left}}/g, "输出结果");
    foot = foot.replace(/{{left}}/g, "");
    // 表单内容
    head = head.replace(/{{right}}/g, ((app) => {
      let html = "";
      app.args.forEach((item) => {
        html += `<div class="field has-addons ${app.name}">`;
        switch (item.type) {
          case "text":
            html += `<div class="control"><label for="${item.name}" class="label button is-static">${item.description}</label></div>`;
            html += `<div class="control"><input name="${item.name}" class="input arg-item" type="text" placeholder="${item.name}" value="${item.default}"></div>`;
            break;

          default:
            break;
        }
        html += `</div>`;
      });
      return html;
    })(app));
    body = body.replace(/{{right}}/g, `<textarea readonly class="textarea auto-select ${app.name}" placeholder="输出结果"></textarea>`);
    foot = foot.replace(/{{right}}/g, `<button class="button is-info ${app.name}">生成</button>`);
    // 输出至页面
    $("#app").append(`<h3 class="title is-4">${app.description}</h3>`);
    $("#app").append(head);
    $("#app").append(body);
    $("#app").append(foot);
    $(`button.${app.name}`).click(function () {
      // alert(`${app.name}`);
      let args = {};
      $(`.field.${app.name} .arg-item`).each(function () {
        args[$(this).attr("name")] = $(this).val();
      });
      // alert(JSON.stringify(args));
      $(`textarea.${app.name}`).val(app.fn(args)).focus().select();
    });
    if (app.auto) {
      $(`button.${app.name}`).click();
    }
  }
  // 用于生成表单的配置项数组
  const apps = [
    {
      "name": "DockerCompose",
      "description": "安装 Docker Compose",
      "auto": true,
      "args": [{
        "name": "version",
        "description": "版本号",
        "type": "text",
        "default": "2.4.1",
        "url": "https://github.com/docker/compose/releases/"
      }],
      "command": ["sudo curl -L https://github.com/docker/compose/releases/download/v{{version}}/docker-compose-`uname -s`-`uname -m` \\", " -o /usr/local/bin/docker-compose", "sudo chmod +x /usr/local/bin/docker-compose", "docker-compose --version"],
      "fn": function (args) {
        let rlt = this.command.join("\n");
        rlt = rlt.replace(/{{version}}/g, args.version.trim("v"));
        return rlt;
      }
    }
  ]

  apps.forEach((item) => {
    fnGenHTML(item);
  });
});
