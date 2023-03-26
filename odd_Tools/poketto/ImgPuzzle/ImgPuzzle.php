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
              <label class="label" for="ImgPuzzle-InPut">选择图片</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <!-- 文件输入入 -->
                  <input id="ImgPuzzle-InPut" name="ImgPuzzle-InPut" class="input select" type="file" placeholder="选择图片" value="">
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal field-btn">
            <div class="field-label">
              <label for="ImgPuzzle-btn" class="label">执行操作</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <!-- 切割 -->
                  <button id="ImgPuzzle-Btn" class="button is-info">
                    切割图片
                  </button>
                  <!-- 还原 -->
                  <button id="ImgPuzzle-Reset" class="button is-info">
                    还原图片
                  </button>
                  <!-- 下载 -->
                  <a id="ImgPuzzle-Down" class="button is-info" href="javascript:;">
                    下载图片
                  </a>
                  <span id="ImgPuzzle-Tips"></span>
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal field-cut">
            <div class="field-label is-normal">
              <span class="label">切割输出</span>
            </div>
            <div class="field-body">
              <div class="field">
                <div id="ImgPuzzle-Cut"></div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal field-view">
            <div class="field-label is-normal">
              <span class="label">原图预览</span>
            </div>
            <div class="field-body">
              <div class="field">
                <div id="ImgPuzzle-View"></div>
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
  <script src="{$host}zb_users/plugin/odd_Tools/lib/html2canvas.min.js"></script>
</body>

</html>
