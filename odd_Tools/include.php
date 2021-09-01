<?php
require __DIR__ . '/function.php';
#注册插件
RegisterPlugin("odd_Tools", "ActivePlugin_odd_Tools");

function ActivePlugin_odd_Tools()
{
  Add_Filter_Plugin('Filter_Plugin_Zbp_BuildTemplate', 'odd_Tools_GenTpl');
  Add_Filter_Plugin('Filter_Plugin_ViewAuto_Begin', 'odd_Tools_Rewrite');
}
function odd_Tools_Rewrite($inpurl, $url)
{
  global $zbp;
  $url = trim($url, "/");
  $qWord = $zbp->Config('odd_Tools')->qWord;
  $r = UrlRule::OutputUrlRegEx("{%host%}{$qWord}/{%alias%}", 'article');
  $m = array();
  if (preg_match($r, $url, $m) == 1) {
    if (isset($m["alias"])) {
      $qVlue = $m["alias"];
    }
    odd_Tools_Display($qVlue);
    die();
  }
  $r = UrlRule::OutputUrlRegEx("{%host%}{$qWord}", 'article');
  $m = array();
  if (preg_match($r, $url, $m) == 1) {
    odd_Tools_Display_Index();
    die();
  }
}
function odd_Tools_GenTpl(&$templates)
{
  global $zbp;
  $tplPath = $zbp->template->GetPath();
  $dir = "{$tplPath}plugin_odd_Tools/";
  if (!is_dir($dir)) {
    @mkdir($dir, 0755);
  }
  $kodoguList = odd_Tools_PathInfosInPoketto();
  foreach ($kodoguList as $name => $doguDir) {
    $curTpl = $doguDir["tpl"];
    if (!is_file($curTpl)) {
      continue;
    }
    $tplCont = file_get_contents($curTpl);
    odd_Tools_FilterTpl($tplCont);
    $templates["plugin_odd_Tools/{$name}"] = $tplCont;
  }
  $arrTpls = GetFilesInDir(odd_Tools_Path("tpl"), "php");
  foreach ($arrTpls as $name => $curTpl) {
    $tplCont = file_get_contents($curTpl);
    odd_Tools_FilterTpl($tplCont);
    $templates["plugin_odd_Tools/{$name}"] = $tplCont;
  }
}
function odd_Tools_Path($file, $t = 'path')
{
  global $zbp;
  $result = $zbp->$t . 'zb_users/plugin/odd_Tools/';
  switch ($file) {
    case 'url':
      return $zbp->host . $zbp->Config('odd_Tools')->qWord . "/";
      break;
    case 'usr':
      return $result . 'usr/';
      break;
    case 'var':
      return $result . 'var/';
      break;
    case 'main':
      return $result . 'main.php';
      break;
    default:
      return $result . $file;
  }
}
function InstallPlugin_odd_Tools()
{
  global $zbp;
  if (!$zbp->HasConfig('odd_Tools')) {
    $zbp->Config('odd_Tools')->version = 1;
    $zbp->Config('odd_Tools')->qWord = "tools";
    $zbp->SaveConfig('odd_Tools');
  }
  $zbp->BuildTemplate();
}
// 插件升级时执行
function UpdatePlugin_odd_Tools()
{
  global $zbp;
  $zbp->BuildTemplate();
  if (!$zbp->Config('odd_Tools')->HasKey("sidebar")){
    $zbp->Config('odd_Tools')->sidebar = '<p><a class="img-wrap" target="_blank" href="https://afdian.net/@wdssmq"><img src="https://www.wdssmq.com/zb_users/logos/afdian.png" alt="爱发电" title="爱发电"></a></p><p>可在后台编辑</p>';
    $zbp->SaveConfig('odd_Tools');
  }
}
// 旧版兼容
function odd_Tools_Updated()
{
  UpdatePlugin_odd_Tools();
}
function UninstallPlugin_odd_Tools()
{
}
