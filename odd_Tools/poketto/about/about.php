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
              <label class="label" for="jsonUrl">JSON</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input id="jsonUrl" name="jsonUrl" class="input" type="text" placeholder="JSON地址" value="{$host}zb_users/plugin/odd_Tools/poketto/about/about.json">
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              预览效果
            </div>
            <div class="field-body">
              <div class="odd-rlt-view"></div>
            </div>
          </div>

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              列表
            </div>
            <div class="field-body">
              <div class="odd-rlt-list field"></div>
            </div>
          </div>

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="about-HTML">HTML</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <details>
                    <summary>HTML 代码</summary>
                    <i class="readonly"></i>
                    <textarea name="about-HTML" spellcheck="false" rows="17" class="odd-rlt textarea" placeholder="生成内容"></textarea>
                  </details>
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
                  <button class="odd-submit button is-primary">
                    提交
                  </button>
                </div>
              </div>
            </div>
          </div><!-- / .field -->
        </div>
        <div class="column">
          <h3>相关推荐：</h3>
          <p>Documentation - substats</p>
          <p><a href="https://substats.swo.moe/" target="_blank" title="Documentation - substats">https://substats.swo.moe/</a></p>
          {template:-plugin-sidebar}
        </div>
      </div><!-- / .columns -->
    </div><!-- / .container -->
  </section>
  {template:-plugin-footer}
  <script src="{$host}zb_users/plugin/odd_Tools/lib/base.js"></script>
</body>

</html>
