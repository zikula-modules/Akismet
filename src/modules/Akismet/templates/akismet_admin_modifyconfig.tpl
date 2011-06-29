{adminheader}
<div class="z-admin-content-pagetitle">
    {icon type="config" size="small"}
    <h3>{gt text="Akismet settings"}</h3>
</div>

<p class='z-informationmsg'>{gt text="%s is a spam detection service that can, in many cases, eliminate comment and trackback spam. To use akismet you need an %s. Simply signup for an account at wordpress.com but don't create a blog - your API key will be in your profile." tag1="<a href='http://akismet.com/'>Akismet</a>" tag2="<a href='http://wordpress.com/api-keys/'>API key</a>"}</p>
<p class='z-informationmsg'>{gt text='Akismet has caught <strong>%s spam</strong> for you so far.' tag1=$modvars.Akismet.count}</p>
<p class='z-informationmsg'>{gt text='To test akismet is functioning submit some content with the author name of "viagra-test-123". This is automatically treated as spam by akismet.'}</p>
<form class="z-form" action="{modurl modname='Akismet' type='admin' func='updateconfig'}" method="post" enctype="application/x-www-form-urlencoded">
    <div>
        <input type="hidden" name="csrftoken" value="{insert name="csrftoken"}" />
        <fieldset>
            <div class="z-formrow">
                <label for="akismet_akismet">{gt text="Enable akismet"}</label>
                <input id="akismet_akismet" name="enable" type="checkbox" value="1"{if $modvars.Akismet.enable eq 1} checked="checked"{/if} />
            </div>
            <div class="z-formrow">
                <label for="akismet_apikey">{gt text="Wordpress.com API key"}</label>
                <input id="akismet_apikey" name="apikey" size="12" maxlength="12" value="{$modvars.Akismet.apikey|safetext}" />
                {if $modvars.Akismet.apikeyvalid neq true}
                <p class="z-formnote z-errormsg">{gt text='Your API key is invalid. Please obtain one from <a href="http://wordpress.com/api-keys/">http://wordpress.com/api-keys/</a>.'}</p>
                {/if}
            </div>
        </fieldset>
        <div class="z-buttons z-formbuttons">
            {button src="button_ok.png" set="icons/extrasmall" __alt="Save" __title="Save" __text="Save"}
            <a href="{modurl modname="Akismet" type="admin" func='modifyconfig'}" title="{gt text="Cancel"}">{img modname='core' src="button_cancel.png" set="icons/extrasmall" __alt="Cancel" __title="Cancel"} {gt text="Cancel"}</a>
        </div>
    </div>
</form>
{adminfooter}