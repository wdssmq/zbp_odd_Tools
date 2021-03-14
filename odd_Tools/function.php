<?php
function odd_Tools_FilterTpl(&$context)
{
  $context = str_replace("-plugin-", "plugin_odd_Tools/", $context);
}
function odd_Tools_Display_Index()
{
  global $zbp;
  $zbp->template->SetTags("title", "怪奇工具箱");
  $zbp->template->SetTags('list', odd_Tools_List());
  $zbp->template->SetTags("description", "各种奇怪的工具列表");
  $zbp->template->Display("plugin_odd_Tools/index");
}
function odd_Tools_Display($name)
{
  global $zbp;
  $kodoguList = odd_Tools_PathInfosInPoketto();
  $curKodogu = $kodoguList[$name];
  // 读取工具信息
  $info = require($curKodogu["info"]);
  $info["appID"] = $name;
  $info["title"] = $info["appName"];
  $zbp->template->SetTags("title", "怪奇工具箱");
  foreach ($info as $key => $value) {
    $zbp->template->SetTags($key, $value);
  }
  $js = $curKodogu["js"];
  if (is_file($js)) {
    $script = str_replace($zbp->path, $zbp->host, $js);;
    $zbp->footer .= "<script src=\"{$script}\"></script>";
  }
  $zbp->template->Display("plugin_odd_Tools/{$name}");
}
function odd_Tools_List($isMng = false)
{
  global $zbp;
  $kodoguList = odd_Tools_PathInfosInPoketto();
  foreach ($kodoguList as $name => $curKodogu) {
    $info =  require($curKodogu["info"]);
    $qWord = $zbp->Config('odd_Tools')->qWord;
    $info["url"] = "{$zbp->host}{$qWord}/{$name}/";
    $kodoguList[$name] = (object)$info;
  }
  if ($isMng) {
    $zbp->template->SetTags('kodoguList', $kodoguList);
    $rlt = $zbp->template->Output("plugin_odd_Tools/admin-list");
    echo $rlt;
  }
  return $kodoguList;
}

function odd_Tools_PathInfosInPoketto()
{
  $pokettoPath = odd_Tools_Path("poketto/", "path");
  $dirs = GetDirsInDir($pokettoPath);
  $rltList = array();
  foreach ($dirs as $name) {
    $curDir = "{$pokettoPath}/{$name}";
    $rltList[$name] = array("dir" => "{$curDir}/", "info" => "{$curDir}/{$name}.info.php", "js" => "{$curDir}/{$name}.js", "tpl" => "{$curDir}/{$name}.php");
  }
  return $rltList;
}

function odd_Tools_a($href, $title, $text = "")
{
  if (empty($text)) {
    $text = $href;
  }
  return "<a target=\"_blank\" href=\"{$href}\" title=\"{$title}\">$text</a>";
}
