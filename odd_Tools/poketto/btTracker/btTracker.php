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
        <div class="column">
          <div class="field">
            <label class="label" for="input">输入</label>
            <div class="control">
              <textarea class="textarea" name="input" id="input" cols="30" rows="10"></textarea>
            </div>
          </div>
        </div>
        <div class="column">
          <div class="field">
            <label class="label" for="output">输入</label>
            <div class="control">
              <textarea class="textarea" name="output" id="output" cols="30" rows="10"></textarea>
            </div>
          </div>
        </div>
      </div><!-- / .columns -->
      <!-- 按钮行 -->
      <div class="columns">
        <div class="column">
          <p class="has-text-centered">
            <button id="btn-sole" class="button is-info">
              去重
            </button>
            <button class="button is-primary" data-clipboard-target="#output" id="btn-copy">
              复制
            </button>
          </p>
        </div>
      </div><!-- / .columns -->
      <h4 class="title">{$appName} - {$description}</h4>
      <!-- 附加信息 -->
      <div class="columns">
        <div class="column">
          <h4>默认从以下项目获取 Trackers</h4>
          <blockquote>
            <p>
              ngosang/trackerslist:
            </p>
            <p>
              <b>https://github.com/ngosang/trackerslist</b>
            </p>
            <p>API - newTrackon</p>
            <p>
              <b>https://newtrackon.com/api</b>
            </p>
          </blockquote>
        </div>
        <div class="column">
          <h4>推荐</h4>
          <p>qBittorrent Official Website</p>
          <p><b>https://www.qbittorrent.org/</b></p>
          <p>bittorrent-tracker-editor</p>
          <p><b>https://github.com/GerryFerdinandus/bittorrent-tracker-editor</b></p>
        </div>
        <div class="column">
          {template:-plugin-sidebar}
        </div>
      </div><!-- / .columns -->
    </div><!-- / .container -->
  </section>
  <script src="https://cdn.bootcss.com/clipboard.js/2.0.4/clipboard.min.js"></script>
  {template:-plugin-footer}
</body>

</html>
