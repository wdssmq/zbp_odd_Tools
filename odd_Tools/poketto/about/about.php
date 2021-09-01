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
              <label class="label">结果</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <i class="readonly"></i>
                  <textarea spellcheck="false" rows="17" class="odd-rlt textarea" placeholder="生成内容"></textarea>
                </div>
              </div>
            </div>
          </div><!-- / .field -->
          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label"></label>
            </div>
            <div class="field-body">
              <details open="true">
                <summary>预览</summary>
                <br>
                <div class="odd-rlt-view"></div>
              </details>
            </div>
          </div>
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
          {template:-plugin-sidebar}
        </div>
      </div><!-- / .columns -->
    </div><!-- / .container -->
  </section>
  {template:-plugin-footer}
</body>

</html>
