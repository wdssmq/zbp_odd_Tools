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
              <label class="label" for="qbit-rss-Feed">RSS 地址</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input id="qbit-rss-Feed" name="qbit-rss-Feed" class="input" type="text" placeholder="输入 RSS 地址">
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="qbit-rss-Category">分类名称</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input id="qbit-rss-Category" name="qbit-rss-Category" class="input" type="text" placeholder="输入分类名称">
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="qbit-rss-Filter">匹配词</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input id="qbit-rss-Filter" name="qbit-rss-Filter" class="input" type="text" placeholder="输入匹配词">
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal">
            <div class="field-label">
              <label class="label">使用正则</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <label class="checkbox">
                    <input id="qbit-rss-Regex" type="checkbox">
                    启用正则表达式匹配
                  </label>
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="qbit-rss-OutPut">生成结果</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <textarea id="qbit-rss-OutPut" name="qbit-rss-OutPut" class="textarea auto-select" rows="10" placeholder="生成的 JSON 配置将显示在这里" readonly></textarea>
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
                  <button id="qbit-rss-Btn" class="button is-info">
                    生成配置
                  </button>
                  <button id="qbit-rss-Download" class="button is-info" style="margin-left: 10px;">
                    下载文件
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
