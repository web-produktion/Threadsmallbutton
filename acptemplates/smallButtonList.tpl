{include file='header'}
<script type="text/javascript" src="{@RELATIVE_WCF_DIR}js/MultiPagesLinks.class.js"></script>

<div class="mainHeadline"> <img src="{@RELATIVE_WCF_DIR}icon/userOptionL.png" alt="" />
	<div class="headlineContainer">
		<h2>{lang}wbb.acp.smallbutton.list{/lang}</h2>
	</div>
</div>

{if $deletedsmallbuttonID}
	<p class="success">{lang}wbb.acp.smallbutton.delete.success{/lang}</p>
{/if}

<div class="contentHeader"> 
	{pages print=true assign=pagesLinks link="index.php?page=SmallButtonList&pageNo=%d&sortField=$sortField&sortOrder=$sortOrder&packageID="|concat:PACKAGE_ID:SID_ARG_2ND_NOT_ENCODED}
	<div class="largeButtons">
		<ul>
			<li><a href="index.php?form=SmallButtonAdd&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/userOptionAddM.png" alt="" title="{lang}wbb.acp.smallbutton.add{/lang}" /> <span>{lang}wbb.acp.smallbutton.add{/lang}</span></a></li>
			{if $additionalLargeButtons|isset}{@$additionalLargeButtons}{/if}	
		</ul>
	</div>
</div>

{if $smallbutton|count}
	<div class="border titleBarPanel">
		<div class="containerHead">
			<h3>{lang}wbb.acp.smallbutton.list.headline{/lang}</h3>
		</div>
	</div>

	<form method="post" action="index.php?action=SmallButtonSort">
		<div class="border borderMarginRemove">
			<table class="tableList">
				<thead>
					<tr class="tableHead">
						<th class="columnsmallbuttonID{if $sortField == 'smallbuttonID'} active{/if}" colspan="3"><div><a href="index.php?page=SmallButtonList&amp;pageNo={@$pageNo}&amp;sortField=smallbuttonID&amp;sortOrder={if $sortField == 'smallbuttonID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}">{lang}wbb.acp.smallbutton.list.smallbuttonID{/lang}{if $sortField == 'smallbuttonID'} <img src="{@RELATIVE_WCF_DIR}icon/sort{@$sortOrder}S.png" alt="" />{/if}</a></div></th>
						<th class="columnimgSrc{if $sortField == 'imgSrc'} active{/if}"><div><a href="index.php?page=SmallButtonList&amp;pageNo={@$pageNo}&amp;sortField=imgSrc&amp;sortOrder={if $sortField == 'imgSrc' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}">{lang}wbb.acp.smallbutton.list.imgSrc{/lang}{if $sortField == 'imgSrc'} <img src="{@RELATIVE_WCF_DIR}icon/sort{@$sortOrder}S.png" alt="" />{/if}</a></div></th>
						<th class="columnname{if $sortField == 'name'} active{/if}"><a href="index.php?page=SmallButtonList&amp;pageNo={@$pageNo}&amp;sortField=name&amp;sortOrder={if $sortField == 'name' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}">{lang}wbb.acp.smallbutton.list.name{/lang}{if $sortField == 'name'} <img src="{@RELATIVE_WCF_DIR}icon/sort{@$sortOrder}S.png" alt="" />{/if}</a></div></th>
						<th class="columndescription{if $sortField == 'description'} active{/if}"><div><a href="index.php?page=SmallButtonList&amp;pageNo={@$pageNo}&amp;sortField=description&amp;sortOrder={if $sortField == 'description' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}">{lang}wbb.acp.smallbutton.list.description{/lang}{if $sortField == 'description'} <img src="{@RELATIVE_WCF_DIR}icon/sort{@$sortOrder}S.png" alt="" />{/if}</a></div></th>
						<th class="columnlinkTo{if $sortField == 'linkTo'} active{/if}"><div><a href="index.php?page=SmallButtonList&amp;pageNo={@$pageNo}&amp;sortField=linkTo&amp;sortOrder={if $sortField == 'linkTo' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}">{lang}wbb.acp.smallbutton.list.linkTo{/lang}{if $sortField == 'linkTo'} <img src="{@RELATIVE_WCF_DIR}icon/sort{@$sortOrder}S.png" alt="" />{/if}</a></div></th>
						{if $additionalColumns|isset}{@$additionalColumns}{/if}
					</tr>
				</thead>
				<tbody>
					{foreach from=$smallbutton item=smallbutton}
						<tr class="{cycle values="container-1,container-2"}">
							<td class="columnIcon">
								{if $this->user->getPermission('admin.smallbutton.canEdit')}
									<select name="smallbuttonListPositions[{@$smallbutton['smallbuttonID']}]">
										{section name='positions' loop=$smallbuttonCount}
											<option value="{@$positions+1}"{if $positions+1 == $smallbutton['showOrder']} selected="selected"{/if}>{@$positions+1}</option>
										{/section}
									</select>
								{/if}
							</td>
							<td class="columnIcon"> {if !$smallbutton.isDisabled} <a href="index.php?action=SmallButtonDisable&amp;smallbuttonID={@$smallbutton.smallbuttonID}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/enabledS.png" alt="" title="{lang}wbb.acp.smallbutton.disable{/lang}" /></a> {else} <a href="index.php?action=SmallButtonEnable&amp;smallbuttonID={@$smallbutton.smallbuttonID}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/disabledS.png" alt="" title="{lang}wbb.acp.smallbutton.enable{/lang}" /></a> {/if} <a href="index.php?form=SmallButtonEdit&amp;smallbuttonID={@$smallbutton.smallbuttonID}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/editS.png" alt="" title="{lang}wbb.acp.smallbutton.edit{/lang}" /></a> <a onclick="return confirm('{lang}wbb.acp.smallbutton.delete.sure{/lang}')" href="index.php?action=SmallButtonDelete&amp;smallbuttonID={@$smallbutton.smallbuttonID}&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/deleteS.png" alt="" title="{lang}wbb.acp.smallbutton.delete{/lang}" /></a></td>
							<td class="columnsmallbuttonID columnID">{$smallbutton.smallbuttonID}</td>
							<td class="columnimgSrc columnText"><img src="{@RELATIVE_WBB_DIR}icon/{$smallbutton.imgSrc}S.png" alt="" title="{lang}wbb.acp.smallbutton.list.imgSrc{/lang}" /></a></td>
							<td class="columnname columnText">{$smallbutton.name}</td>
							<td class="columndescription columnText">{$smallbutton.description}</td>
							<td class="columnsmallbuttonAttributes columnText"><a href="{$smallbutton.linkTo}">{$smallbutton.linkTo}</a></td>
							{if $smallbutton.additionalColumns|isset}{@$smallbutton.additionalColumns}{/if}
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>

	<div class="contentHeader">
		{pages print=true assign=pagesLinks link="index.php?page=SmallButtonList&pageNo=%d&sortField=$sortField&sortOrder=$sortOrder&packageID="|concat:PACKAGE_ID:SID_ARG_2ND_NOT_ENCODED}
		<div class="largeButtons">
			<ul>
				<li><a href="index.php?form=SmallButtonAdd&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/userOptionAddM.png" alt="" title="{lang}wbb.acp.smallbutton.list{/lang}" /> <span>{lang}wbb.acp.smallbutton.add{/lang}</span></a></li>
				{if $additionalLargeButtons|isset}{@$additionalLargeButtons}{/if}
			</ul>
		</div>
	</div>

		<div class="formSubmit">
			<input type="submit" accesskey="s" value="{lang}wcf.global.button.submit{/lang}" />
			<input type="reset" accesskey="r" id="reset" value="{lang}wcf.global.button.reset{/lang}" />
			<input type="hidden" name="packageID" value="{@PACKAGE_ID}" />
			{@SID_INPUT_TAG}
		</div>
	</form>
{else}
	<div class="info">
		<p>{lang}wbb.acp.smallbutton.list.noItem{/lang}</p>
	</div>
{/if}

{include file='footer'} 