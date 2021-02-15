<?php
function odd_Tools_FilterTpl(&$context)
{
  $context = str_replace("-plugin-", "plugin_odd_Tools/", $context);
}
function odd_Tools_Display($name)
{
  global $zbp;
  $pokettoUrl = odd_Tools_Path("poketto/", "host");
  $zbp->template->SetTags("pokettoUrl", $pokettoUrl);
  $info = require(odd_Tools_Path("poketto/{$name}/{$name}.info.php"));
  $info["appID"] = $name;
  foreach ($info as $key => $value) {
    $zbp->template->SetTags($key, $value);
  }
  $js = odd_Tools_Path("{$name}/{$name}.js");
  if (is_file($js)) {
    $script = odd_Tools_Path("{$name}/{$name}.js", "host");
    $zbp->footer .= "<script src=\"{$script}\"></script>";
  }
  $zbp->template->Display("plugin_odd_Tools/{$name}");
}
function odd_Tools_List()
{
  global $zbp;
  $kodoguList = odd_Tools_GetDirsInPoketto();
  foreach ($kodoguList as $name => $dir) {
    $info =  require("{$dir}/${name}.info.php");
    $qWord = $zbp->Config('odd_Tools')->qWord;
    $info["url"] = "{$zbp->host}{$qWord}/{$name}/";
    $kodoguList[$name] = (object)$info;
  }
  $zbp->template->SetTags('list', $kodoguList);
  $rlt = $zbp->template->Output("plugin_odd_Tools/admin-list");
  echo $rlt;
}

function odd_Tools_GetDirsInPoketto()
{
  $pokettoPath = odd_Tools_Path("poketto/", "path");
  $dirs = GetDirsInDir($pokettoPath);
  $rltDirs = array();
  foreach ($dirs as $name) {
    $rltDirs[$name] = "{$pokettoPath}/{$name}/";
  }
  return $rltDirs;
}
