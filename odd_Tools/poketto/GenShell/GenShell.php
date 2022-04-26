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

          <h2 class="title">{$appName} - {$description}</h2>
          <div id="app"></div>

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
</body>

</html>
