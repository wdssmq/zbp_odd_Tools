<?php die(); ?>
<!DOCTYPE html>
<html lang="{$language}">

<head>
  {template:-plugin-header}
</head>

<body class="{$type}">
  {template:-plugin-hero}
  <section class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-four-fifths">

          <!-- 标题描述 -->
          <div class="field is-horizontal">
            <div class="field-label">
              <label class="label is-hidden">{$appName}</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  {$description}
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="PBKDF2-username">用户名</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input id="PBKDF2-username" name="PBKDF2-username" class="input select" type="text" placeholder="用户名" value="test">
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="PBKDF2-password">密码</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input id="PBKDF2-password" name="PBKDF2-password" class="input select" type="text" placeholder="密码" value="123456">
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="PBKDF2-iterations">循环次数</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <div class="select">
                    <select id="PBKDF2-iterations">
                      <option value="1e6">100 万</option>
                      <option value="3e6" selected>300 万</option>
                      <option value="5e6">500 万</option>
                      <option value="1e7">1000 万</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <hr>
          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="PBKDF2-HexStr">输出</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <i class="readonly"></i>
                  <input id="PBKDF2-HexStr" name="PBKDF2-HexStr" class="input select" type="text" placeholder="输出" value="">
                </div>

              </div>
            </div>
          </div><!-- / .field -->
          <hr>

          <div class="field is-horizontal">
            <div class="field-label">
              <!-- Left empty for spacing -->
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <button id="PBKDF2-Btn" class="button is-info js-timer">
                    执行
                  </button>
                </div>
              </div>
            </div>
          </div><!-- / .field -->
        </div>
        <div class="column">
          {template:-plugin-sidebar}
        </div>
      </div><!-- / .columns -->
    </div><!-- / .container -->
  </section>
  {template:-plugin-footer}
  <!-- 一键复制 -->
  <!-- <script src="https://cdn.bootcss.com/clipboard.js/2.0.4/clipboard.min.js"></script> -->
  <script src="{$host}zb_users/plugin/odd_Tools/poketto/PBKDF2/script/lib-pbkdf2.js"></script>
</body>

</html>
