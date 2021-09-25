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
              <label class="label" for="defText">输入内容</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input id="defText" name="defText" class="input select" type="text" placeholder="原始文本" value="测试">
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="toPinyin">插入文本</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input id="toPinyin" name="toPinyin" class="input select" type="text" placeholder="插入文本" value="卖萌">
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="PinyinOutPut">执行结果</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input id="PinyinOutPut" name="PinyinOutPut" class="input select" type="text" placeholder="执行结果" value="">
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
                  <button id="btn-Pinyin" class="button is-info">
                    走你
                  </button>
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <hr>

          <div class="field is-horizontal">
            <div class="field-label">
              推荐
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <p><a href="{odd_Tools_Path('url')}codeUrl/" title="移除网址内的汉字，或者添加">codeUrl - 移除网址内的汉字，或者添加</a></p>
                  <p><a href="{odd_Tools_Path('url')}Pinyin/" title="向文本内间(zhe)隔(yang)插入拼音；">Pinyin - 向文本内间(zhe)隔(yang)插入拼音；</a></p>
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
  {template:-plugin-footer}、
  <!-- 一键复制 -->
  <!-- <script src="https://cdn.bootcss.com/clipboard.js/2.0.4/clipboard.min.js"></script> -->
</body>

</html>
