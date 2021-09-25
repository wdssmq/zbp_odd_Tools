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
              <label class="label" for="newNameInPut">输入内容</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input id="newNameInPut" name="newNameInPut" class="input select" type="text" placeholder="输入内容" value="">
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="newNameOutPut">执行结果</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input id="newNameOutPut" name="newNameOutPut" class="input select" type="text" placeholder="执行结果" value="">
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
                  <button id="btn-newName" class="button is-info">
                    newName
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
  {template:-plugin-footer}、
  <!-- 一键复制 -->
  <!-- <script src="https://cdn.bootcss.com/clipboard.js/2.0.4/clipboard.min.js"></script> -->
</body>

</html>
