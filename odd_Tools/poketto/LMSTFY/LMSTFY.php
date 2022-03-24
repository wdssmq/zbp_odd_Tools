<?php die(); ?>
<!DOCTYPE html>
<html lang="{$language}">

<head>
  {template:-plugin-header}
  <style>
    .mr-20{
      margin-right: 20px;
    }
  </style>
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
              <label class="label" for="LMSTFY-InPut">输入内容</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input id="LMSTFY-InPut" name="LMSTFY-InPut" class="input select" type="text" placeholder="输入你的问题" value="">
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          {php}<?php

                $arrEngine = array(
                  "必应（Bing）" => "https://cn.bing.com/search?q={query}",
                  "搜狗（Sougou）" => "https://www.sogou.com/web?query={query}",
                  "谷歌（Google）" => "https://www.google.com/search?q={query}",
                  "百度（Baidu）" => "https://www.baidu.com/s?wd={query}",
                )

                ?>{/php}

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label">搜索引擎</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  {$hasSetDef=false}
                  {foreach $arrEngine as $key => $value}
                  <label class="radio" title="{$key}">
                    {if $hasSetDef}
                    <input type="radio" data-url="{$value}" name="LMSTFY-Engine">
                    {else}
                    <input type="radio" data-url="{$value}" name="LMSTFY-Engine" checked>
                    {$hasSetDef=true}
                    {/if}
                    {$key}
                  </label>
                  {/foreach}
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
                <div class="control is-flex is-align-items-center">
                  <button id="LMSTFY-btn" class="button is-info mr-20">
                    生成搜索
                  </button>
                  <button id="LMSTFY-btn-search" class="button is-info mr-20 is-hidden">
                    点击查看
                  </button>
                  <span class="js-tips"> ← 输入一个问题，然后点击按钮；</span>
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <hr>

          <div class="field is-horizontal is-hidden js-OutPut-Content">
            <div class="field-label is-normal">
              <label class="label" for="LMSTFY-OutPut">用于分享</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <!-- <input class="input select" type="text" placeholder="执行结果" value=""> -->
                  <textarea class="textarea auto-select" id="LMSTFY-OutPut" name="LMSTFY-OutPut" cols="30" rows="3"></textarea>
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
</body>

</html>
