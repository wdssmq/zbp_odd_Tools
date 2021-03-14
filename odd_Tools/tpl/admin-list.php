{foreach $kodoguList as $kodogu}
<p>工具名：{$kodogu.appName}</p>
<p>描述：{$kodogu.description}</p>
<p>网址：<a href="{$kodogu.url}" title="{$kodogu.appName}" target="_blank">{$kodogu.url}</a></p>
<hr>
{/foreach}
