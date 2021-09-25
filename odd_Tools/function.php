<?php
function odd_Tools_FilterTpl(&$context)
{
  $context = str_replace("-plugin-", "plugin_odd_Tools/", $context);
}
// 工具条首页
function odd_Tools_Display_Index()
{
  global $zbp;
  $zbp->template->SetTags("type", "index");
  $zbp->template->SetTags("title", "怪奇工具箱");
  $zbp->template->SetTags('list', odd_Tools_List());
  $zbp->template->SetTags("description", "各种奇怪的工具列表");
  $zbp->template->Display("plugin_odd_Tools/index");
}
// 内页
function odd_Tools_Display($name)
{
  global $zbp;
  $kodoguList = odd_Tools_PathInfosInPoketto();
  $curKodogu = $kodoguList[$name];
  // 读取工具信息
  $info = require($curKodogu["info"]);
  $info["appID"] = $name;
  $info["title"] = $info["appName"];
  $zbp->template->SetTags("type", $name);
  $zbp->template->SetTags("title", "怪奇工具箱");
  foreach ($info as $key => $value) {
    $zbp->template->SetTags($key, $value);
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

// 获取 poketto 内项目的路径信息；
function odd_Tools_PathInfosInPoketto()
{
  $pokettoPath = odd_Tools_Path("poketto", "path");
  $dirs = GetDirsInDir($pokettoPath);
  $rltList = array();
  foreach ($dirs as $name) {
    $curDir = "{$pokettoPath}/{$name}";
    $rltList[$name] = array("dir" => "{$curDir}/", "info" => "{$curDir}/{$name}.info.php", "js" => "{$curDir}/{$name}.js", "tpl" => "{$curDir}/{$name}.php");
  }
  return $rltList;
}

// 创建新工具文件夹
function odd_Tools_CreatDogu($newName, $newDesc)
{
  $tpl_dir = odd_Tools_Path("tpl_new");
  $target_dir = odd_Tools_Path("poketto/{$newName}");
  // 判断存在
  if (is_dir($target_dir)) {
    return false;
  }
  @mkdir($target_dir, 0755);
  // 复制文件
  $tpl_files = GetFilesInDir($tpl_dir, "js|php");
  foreach ($tpl_files as $tpl_name => $tpl_file) {
    $con = file_get_contents($tpl_file);
    $con = strtr($con, array("newName" => $newName, "newDesc" => $newDesc));
    $target_file = str_replace($tpl_dir, $target_dir, $tpl_file);
    $target_file = str_replace("name.", "{$newName}.", $target_file);
    $target_file = str_replace(".tpl", "", $target_file);
    file_put_contents($target_file, $con);
  }
}

// 输出链接
function odd_Tools_a($href, $title, $text = "")
{
  if (empty($text)) {
    $text = $href;
  }
  return "<a target=\"_blank\" href=\"{$href}\" title=\"{$title}\">$text</a>";
}
