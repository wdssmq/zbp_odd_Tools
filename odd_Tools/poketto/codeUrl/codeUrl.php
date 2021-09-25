<?php die();?>
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
              <label class="label">{$appName}</label>
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
              <label class="label" for="inpUrl">输入内容</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input id="inpUrl" name="inpUrl" class="input" type="text" placeholder="输入内容" value="">
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="outUrl">执行结果</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input id="outUrl" name="outUrl" class="input" type="text" placeholder="执行结果" value="">
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal">
            <div class="field-label">
              <!-- Left empty for spacing -->
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <button class="odd-decode button is-info">
                    移除汉字
                  </button>
                  <button class="odd-encode button is-info">
                    添加汉字
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
</body>

</html>
