<?php die(); ?>
<!DOCTYPE html>
<html lang="{$language}">

<head>
  {template:-plugin-header}
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
</head>

<body class="{$type}">
  {template:-plugin-hero}
  <section class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-four-fifths">

          <h2 class="title is-4">
            {$description}
          </h2>

          <div class="table-container">
            <table x-data="table()" x-init="_init()" class="table is-fullwidth is-hoverable">
              <thead>
                <tr>
                  <th>数量</th>
                  <th>总价</th>
                  <th width="17%">备注</th>
                  <th>单价（只读）</th>
                </tr>
              </thead>
              <template x-for="(tr, index) in rows" :key="index">
                <tr>
                  <td>
                    <input @input="_update()" class="input" type="number" step="0.1" x-model="rows[index].num">
                  </td>
                  <td>
                    <input @input="_update()" class="input" type="number" step="0.01" x-model="rows[index].sum">
                  </td>
                  <td>
                    <input @input="_update()" class="input" type="text" x-model="rows[index].note">
                  </td>
                  <td>
                    <input readonly="true" class="input" type="text" :value="rows[index].unit">
                  </td>
                </tr>
              </template>
              <tr>
                <td colspan="4"><input @click="_add" class="button is-primary is-outlined is-fullwidth" type="button" value="添加行"></td>
              </tr>
            </table>
          </div>

          <script>
            const lsObj = {
              get: function(key, def = null) {
                const item = localStorage.getItem(key);
                if (item) {
                  return JSON.parse(item);
                }
                return def;
              },
              set: function(key, value) {
                localStorage.setItem(key, JSON.stringify(value));
              }
            };

            function table() {
              return {
                rows: [],
                lstRow: {},
                _update() {
                  // parseFloat() 会把 1. 变成 1
                  this.rows.forEach(row => {
                    row.unit = row.sum / row.num
                    // 保留两位小数
                    row.unit = row.unit.toFixed(2);
                  });
                  // console.log(JSON.stringify(this.rows));
                  this._save();
                },
                _save() {
                  const lsData = [];
                  this.rows.forEach(row => {
                    if (row.sum / row.num > 1) {
                      lsData.push(row);
                    }
                  });
                  this._sort(lsData);
                  lsObj.set('odd-tools-unit-price', lsData);
                },
                _sort(objList) {
                  // 排序
                  objList.sort((a, b) => {
                    // 按 note 字符串排序
                    if (a.note !== b.note) {
                      // 2022-06-20 - 2020-09-20
                      a.note = a.note || '';
                      b.note = b.note || '';
                      // 2022-06-20 - 2020-09-20
                      return -a.note.localeCompare(b.note);
                    }
                    // 按 num 值排序
                    if (a.num !== b.num) {
                      return a.num - b.num;
                    }
                    // 按 sum 值排序
                    if (a.sum !== b.sum) {
                      return a.sum - b.sum;
                    }
                  });
                },
                _add() {
                  let curNum = 1;
                  if (this.lstRow.num) {
                    curNum = parseFloat(this.lstRow.num) + 1;
                  }
                  this.lstRow = {
                    num: curNum,
                    sum: curNum,
                    unit: curNum / curNum,
                    note: ''
                  };
                  this.rows.push(this.lstRow);
                },
                _loadLstRow(lsData) {
                  this.lstRow = lsData[lsData.length - 1];
                },
                _init() {
                  const lsData = lsObj.get('odd-tools-unit-price');
                  if (lsData === null || lsData.length === 0) {
                    this._add();
                  } else {
                    // this._sort(lsData);
                    this._loadLstRow(lsData);
                    this.rows = lsData;
                  }
                }
              }
            }
          </script>

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
