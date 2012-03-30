{include file='header'}
<script type="text/javascript" src="{@RELATIVE_WCF_DIR}js/MultiPagesLinks.class.js"></script>

<div class="mainHeadline">
	<img src="{@RELATIVE_WCF_DIR}icon/userOption{@$action|ucfirst}L.png" alt="" />
	<div class="headlineContainer">
		<h2>{lang}wbb.acp.smallbutton.{@$action}{/lang}</h2>
	</div>
</div>

{if $success|isset}
	<p class="success">{lang}wbb.acp.smallbutton.{@$action}.success{/lang}</p>	
{/if}

<div class="contentHeader">
	<div class="largeButtons">
		<ul><li><a href="index.php?page=SmallButtonList&amp;packageID={@PACKAGE_ID}{@SID_ARG_2ND}"><img src="{@RELATIVE_WCF_DIR}icon/userOptionM.png" alt="" title="{lang}wbb.acp.smallbutton.list{/lang}" /> <span>{lang}wbb.acp.smallbutton.list{/lang}</span></a></li></ul>
	</div>
</div>

<form method="post" action="index.php?form=SmallButton{@$action|ucfirst}">
	<div class="border content">
		<div class="container-1">
			<fieldset>
				<legend>{lang}wbb.acp.smallbutton.data{/lang}</legend>
				
				<div class="formElement{if $errorField == 'name'} formError{/if}" id="nameDiv">
					<div class="formFieldLabel">
						<label for="name">{lang}wbb.acp.smallbutton.name{/lang}</label>
					</div>
					<div class="formField">
						<input type="text" class="inputText" id="name" name="name" value="{$name}" />
						{if $errorField == 'name'}
							<p class="innerError">
								{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
							</p>
						{/if}
					</div>
					<div class="formFieldDesc hidden" id="nameHelpMessage">
						{lang}wbb.acp.smallbutton.name.description{/lang}
					</div>
					<script type="text/javascript">//<![CDATA[
					inlineHelp.register('name');
					//]]></script>
				</div>
				
				<div class="formElement{if $errorField == 'description'} formError{/if}" id="nameDiv">
					<div class="formFieldLabel">
						<label for="description">{lang}wbb.acp.smallbutton.description{/lang}</label>
					</div>
					<div class="formField">
						<input type="text" class="inputText" id="description" name="description" value="{$description}" />
						{if $errorField == 'description'}
							<p class="innerError">
								{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
							</p>
						{/if}
					</div>
					<div class="formFieldDesc hidden" id="descriptionHelpMessage">
						{lang}wbb.acp.smallbutton.description.description{/lang}
					</div>
					<script type="text/javascript">//<![CDATA[
					inlineHelp.register('description');
					//]]></script>
				</div>
				
				<div class="formElement{if $errorField == 'linkTo'} formError{/if}" id="nameDiv">
					<div class="formFieldLabel">
						<label for="linkTo">{lang}wbb.acp.smallbutton.linkTo{/lang}</label>
					</div>
					<div class="formField">
						<input type="text" class="inputText" id="linkTo" name="linkTo" value="{$linkTo}" />
						{if $errorField == 'linkTo'}
							<p class="innerError">
								{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
							</p>
						{/if}
					</div>
					<div class="formFieldDesc hidden" id="linkToHelpMessage">
						{lang}wbb.acp.smallbutton.linkTo.description{/lang}
					</div>
					<script type="text/javascript">//<![CDATA[
					inlineHelp.register('linkTo');
					//]]></script>
				</div>
				
				<div class="formElement{if $errorField == 'imgSrc'} formError{/if}" id="nameDiv">
					<div class="formFieldLabel">
						<label for="imgSrc">{lang}wbb.acp.smallbutton.imgSrc{/lang}</label>
					</div>
					<div class="formField">
						<input type="text" class="inputText" id="imgSrc" name="imgSrc" value="{$imgSrc}" />
						{if $errorField == 'imgSrc'}
							<p class="innerError">
								{if $errorType == 'empty'}{lang}wcf.global.error.empty{/lang}{/if}
							</p>
						{/if}
					</div>
					<div class="formFieldDesc hidden" id="imgSrcHelpMessage">
						{lang}wbb.acp.smallbutton.imgSrc.description{/lang}
					</div>
					<script type="text/javascript">//<![CDATA[
					inlineHelp.register('imgSrc');
					//]]></script>
				</div>
			</fieldset>
		</div>
	</div>

	<div class="formSubmit">
		<input type="submit" accesskey="s" value="{lang}wcf.global.button.submit{/lang}" />
		<input type="reset" accesskey="r" value="{lang}wcf.global.button.reset{/lang}" />
		<input type="hidden" name="packageID" value="{@PACKAGE_ID}" />
		{if $smallbuttonID|isset}<input type="hidden" name="smallbuttonID" value="{@$smallbuttonID}" />{/if}
		{@SID_INPUT_TAG}
 	</div>
</form>

{include file='footer'}