{if $smallbutton|count > 0}
	{foreach from=$smallbutton item=row}
		<li><a href="{$row.linkTo}{@SID_ARG_2ND}" title="{lang}{$row.description}{/lang}"><img src="{icon}{$row.imgSrc}S.png{/icon}" alt="" /> <span>{lang}{$row.name}{/lang}</span></a></li>
	{/foreach}
{/if}