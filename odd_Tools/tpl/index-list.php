{foreach $list as $info}
<!-- item -->
<div class="column is-one-third">
  <div class="kodogu-multi is-flex is-align-items-center">
    <div class="multi-left">
      <span>A</span>
    </div>
    <div class="multi-right">
      <h3><a href="{$info.url}" title="{$info.appName}">{$info.appName}</a></h3>
      <p class="has-text-grey	">{$info.description}</p>
    </div>
  </div>
</div>
<!-- /item -->
{/foreach}
