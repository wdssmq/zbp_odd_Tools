<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action = 'root';
if (!$zbp->CheckRights($action)) {
  $zbp->ShowError(6);
  die();
}
if (!$zbp->CheckPlugin('odd_Tools')) {
  $zbp->ShowError(48);
  die();
}

$act = GetVars('act', 'GET');
$suc = GetVars('suc', 'GET');
if ($act == 'save') {
  CheckIsRefererValid();
  foreach ($_POST as $key => $val) {
    if (substr($key, 0, 5) == 'read_') {
      continue;
    }
    $zbp->Config('odd_Tools')->$key = trim($val);
  }
  $zbp->SaveConfig('odd_Tools');
  $zbp->BuildTemplate();
  $zbp->SetHint('good');
  Redirect('./main.php' . ($suc == null ? '' : "?act={$suc}"));
}

if ($act == 'new') {
  CheckIsRefererValid();
  $newName = GetVars('newName', 'POST');
  $newDesc = GetVars('newDesc', 'POST');
  if (empty($newName) || empty($newDesc)) {
    $zbp->SetHint('tips',"输入为空");
  } else {
    odd_Tools_CreatDogu($newName, $newDesc);
    $zbp->BuildTemplate();
    $zbp->SetHint('good');
  }
  Redirect('./main.php' . ($suc == null ? '' : "?act={$suc}"));
}

InstallPlugin_odd_Tools();

$blogtitle = '怪奇工具箱';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle; ?></div>
  <div class="SubMenu"></div>
  <div id="divMain2">
    <div class="content-box">
      <ul class="content-box-tabs">
        <li><a href="#def" class="default-tab current">开始</a></li>
        <li><a href="#config">配置项</a></li>
        <li><a href="#about" class="xnxf-about-btn tab-btn">关于</a></li>
      </ul>
      <div style="clear: both"></div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="def">
          <hr>
          <p>首页：<?php echo odd_Tools_a(odd_Tools_Path("url"), "工具箱首页"); ?></p>
          <hr>
          <?php odd_Tools_List(1); ?>
        </div>
        <div class="tab-content" id="config">
          <form action="<?php echo BuildSafeURL("main.php?act=save"); ?>" method="post">
            <table width="100%" class="tableBorder">
              <tr>
                <th width="10%">项目</th>
                <th>内容</th>
                <th width="45%">说明</th>
              </tr>
              <tr>
                <td>侧栏项</td>
                <td><?php zbpform::textarea("sidebar", htmlspecialchars($zbp->Config("odd_Tools")->sidebar), "90%"); ?></td>
                <td>工具页侧栏内容</td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2"><input type="submit" value="提交" /></td>
              </tr>
            </table>
          </form>
          <hr>
          <h4>新建</h4>
          <form action="<?php echo BuildSafeURL("main.php?act=new"); ?>" method="post">
            <table width="100%" class="tableBorder">
              <tr>
                <th width="10%">项目</th>
                <th>内容</th>
                <th width="45%">说明</th>
              </tr>
              <tr>
                <td>name：</td>
                <td><?php zbpform::text("newName", "", "90%"); ?></td>
                <td></td>
              </tr>
              <tr>
                <td>描述说明：</td>
                <td><?php zbpform::text("newDesc", "", "90%"); ?></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td colspan="2"><input type="submit" value="创建" /></td>
              </tr>
            </table>
          </form>
        </div>
        <div class="tab-content" id="about">
          <?php require "about.php"; ?>
        </div>
      </div>
    </div>

  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>
