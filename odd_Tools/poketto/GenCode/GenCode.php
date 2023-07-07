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
              输入内容
            </div>
            <div class="field-body">
              <div class="is-flex is-align-items-center">
                <div class="control">
                  <div class="field">
                    <div class="control"><input id="GenCode-Num" name="GenCode-Num" class="input select" type="number" placeholder="输入一个数字" value="" min="0"></div>
                    <!-- <div class="control"><label for="GenCode-Num" class="label button is-static">记忆码</label></div> -->
                  </div>
                </div>
                <span> - </span>
                <div class="control">
                  <div class="field has-addons">
                    <div class="control">
                      <div class="select">
                        <select id="GenCode-Cycle">
                          <option>457</option>
                          <option>419</option>
                          <option>379</option>
                          <option selected>337</option>
                          <option>257</option>
                          <option>179</option>
                          <option>137</option>
                        </select>
                      </div>
                    </div>
                    <div class="control"><label for="GenCode-Cycle" class="label button is-static">时间周期</label></div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- / .field -->

          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label" for="GenCode-Out-01">执行结果</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input id="GenCode-Out-01" name="GenCode-Out-01" class="input select" type="text" placeholder="执行结果" value="">
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
                  <button id="GenCode-Auto" class="button is-info">
                    批量生成
                  </button>
                  <button id="GenCode-Del" class="button is-info">
                    删除历史
                  </button>
                </div>
                <hr>
                <div id="GenCode-History">

                </div>
                <hr>
                <div>
                  <div class="page-section-header hr-bottom">
                    <h4 class="ti">说明：</h4>
                  </div>
                  <div class="page-section-body em-dot-85">
                    <div>1. 输出结果为 4 个字母外加一个数字；</div>
                    <div>2. 数字表示当前周期的剩余天数；</div>
                    <div>3. 对于相同输入及周期参数，在当前周期内将得到相同的字母；</div>
                    <div>4. 请在充分理解本说明的前提下使用生成的字母；</div>
                  </div>
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
  <script src="{$host}zb_users/plugin/odd_Tools/lib/base.js"></script>
</body>

</html>
