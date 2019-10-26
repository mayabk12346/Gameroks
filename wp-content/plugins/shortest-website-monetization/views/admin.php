<div class="wrap shortest-admin">
	<?php
        Shortest_Monetization::get_api_token();
        $withAPI = get_option('shst_api_ready');
        $token = get_option('shst_token');
        $email = get_option('shst_email');
        $connectionMethod = get_option('shst_connection_method');
    ?>

	<h2 class="shortest-header-widget"><?php echo esc_html(get_admin_page_title()); ?></h2>
    <div class="shortest-left">
        <form method="post" action="options.php" id="shst_form">
            <input type="hidden" name="shst_connection_method" value="<?php echo esc_html($connectionMethod); ?>" />
            <?php settings_fields('shst-settings-group'); ?>
            <?php do_settings_sections('shst-settings-group'); ?>
            <div class="shortest-settings-group">
                <h2 class="shortest-header">Shorte.st account connection</h2>
                <div class="shortest-options-group shortest-text">
                    Select the preferred connection method:
                    <div id="shortest-connection-method">
                        <a href="#" id="shortest-connection-method-email"
                           class="<?php echo ($connectionMethod == 'email') ? 'active' : ''; ?>">Email (default)</a>
                        <a href="#" id="shortest-connection-method-token"
                           class="<?php echo ($connectionMethod == 'token') ? 'active' : ''; ?>">API token</a>
                    </div>
                </div>

                <div id="shortest-options-with-email" class="shortest-options <?php echo ($connectionMethod == 'email') ? 'active' : ''; ?>">
                    <div class="shortest-options-group">
                        <label class="shortest-label" for="shst_email" style="font-weight: bold">Your Shorte.st email</label>
                        <input type="text" class="shortest-input-text" id="shst_email" name="shst_email"
                               value="<?php echo esc_html($email); ?>" placeholder="Registered email" />
                    </div>

                    <?php if (empty($email) && empty($token)): ?>
                    <div class="shortest-options-group shortest-text">
                        Status <strong style="color: #E44926">Not connected</strong> with a Shorte.st account.<br/><br/>

                        Provide your Shorte.st registration email and click on <strong>‘Save changes’</strong>
                        button to connect the plugin with your account.
                    </div>
                    <?php endif ?>

                    <?php if (!empty($email) && !empty($token)): ?>
                        <div class="shortest-options-group shortest-text">
                            Status <strong style="color: #39BB1E">Connected</strong> with a Shorte.st account.
                        </div>
                    <?php endif ?>

                    <?php if (!empty($email) && empty($token)): ?>
                        <div class="shortest-options-group shortest-text">
                            Status <strong style="color: #E44926">Not connected</strong> with a Shorte.st account.<br/><br/>

                            Plugin couldn’t match a Shorte.st account with this email address.
                            Double check the provided email and click on <strong>‘Save changes’</strong> button to revalidate.<br/><br/>

                            For some users it might be necessary to connect the plugin via Shorte.st <a href="#" id="shortest-api-token-switch" class="shortest-url">API token</a> instead.
                        </div>
                    <?php endif ?>

                    <?php if (empty($email) && !empty($token)): ?>
                        <div class="shortest-options-group shortest-text">
                            Provide your Shorte.st registration email and click on <strong>‘Save changes’</strong>
                            button to connect the plugin with your account.
                        </div>
                    <?php endif ?>
                </div>

                <div id="shortest-options-with-token" class="shortest-options <?php echo ($connectionMethod == 'token') ? 'active' : ''; ?>">
                    <div class="shortest-options-group">
                        <label class="shortest-label" for="shst_token" style="font-weight: bold">Your API token</label>
                        <input type="text" class="shortest-input-text" id="shst_token" name="shst_token"
                               value="<?php echo esc_html($token); ?>" placeholder="Paste your API token" />
                    </div>

                    <div class="shortest-options-group shortest-text">
                        <a href="https://shorte.st/tools/api" target="_blank" class="shortest-url">Copy your token from the Shorte.st user panel</a>.<br/><br/>

                        <?php if (empty($token)): ?>
                        Only use this method if you’re experiencing problems with connecting via email.
                        <?php else: ?>
                        Double check that the plugin is connected properly by observing if views show up on your Shorte.st dashboard.
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="shortest-settings-group">
                <div class="shortest-options-group">
                    <h2 class="shortest-header">Links </h2>
                    <div class="shortest-switcher <?php if(get_option('shst_fps_enabled')): ?>active<?php endif;?>" id="switcher01">
                        <div class="switch <?php if(get_option('shst_fps_enabled')): ?>on<?php endif;?>"></div>
                        <input type="checkbox" id="shst_fpsenabled" name="shst_fps_enabled" <?php if(get_option('shst_fps_enabled')): ?>checked="checked"<?php endif;?> value="1">
                    </div>
                </div>
                <div class="switcher-visibility switcher01  <?php if(get_option('shst_fps_enabled')): ?>active<?php endif;?>">
                    <div class="shortest-options-group">
                        <label class="shortest-label" for="shst_fps_selection_types">Domains selection type</label>
                        <select id="shst_fps_selection_types" name="shst_fps_selection_type" required="required">
                            <option value="<?= Shortest_Monetization::FPS_SELECTION_TYPE_EXCLUDE ?>"
                                <?php if(intval(get_option('shst_fps_selection_type')) === Shortest_Monetization::FPS_SELECTION_TYPE_EXCLUDE):?>
                                    selected="selected"
                                <?php endif;?>>Exclude
                            </option>
                            <option value="<?= Shortest_Monetization::FPS_SELECTION_TYPE_INCLUDE ?>"
                                <?php if(intval(get_option('shst_fps_selection_type')) === Shortest_Monetization::FPS_SELECTION_TYPE_INCLUDE):?>
                                    selected="selected"
                                <?php endif;?>>Include
                            </option>
                        </select>
                    </div>
                    <div class="shortest-options-group">
                        <label class="shortest-label" for="shst_fps_domains_list">Domains list (comma separated)</label>
                        <textarea class="shortest-textarea" id="shst_fps_domains_list" name="shst_fps_domains_list" rows="1" cols="100"><?php
                            echo esc_html(get_option('shst_fps_domains_list'));
                        ?></textarea>
                    </div>
                    <div class="shortest-options-group">
                        <h3 class="shortest-header">Capping</h3>
                        <input type="text" class="shortest-capping-input-text shortest-input-text shortest-number" id="shst_fps_capping_limit" name="shst_fps_capping_limit"
                               value="<?php echo esc_html( get_option('shst_fps_capping_limit') ); ?>"
                            />
                        <div class="sep">/</div>
                        <input type="text" class="shortest-capping-input-text shortest-input-text shortest-number" id="shst_fps_capping_timeout" name="shst_fps_capping_timeout"
                                value="<?php echo esc_html( get_option('shst_fps_capping_timeout') ); ?>"
                            />
                        <div class="sep">hours</div>
                    </div>
                </div>
            </div>
            <div class="shortest-settings-group">
                <div class="shortest-options-group">
                    <h2 class="shortest-header">Entries</h2>
                    <div class="shortest-switcher <?php if(get_option('shst_es_enabled')): ?>active<?php endif;?>" id="switcher03">
                        <div class="switch <?php if(get_option('shst_es_enabled')): ?>on<?php endif;?>"></div>
                        <input type="checkbox" id="shst_fpsenabled" name="shst_es_enabled" <?php if(get_option('shst_es_enabled')): ?>checked="checked"<?php endif;?> value="1">
                    </div>
                </div>
                <div class="switcher-visibility switcher03 <?php if(get_option('shst_es_enabled')): ?>active<?php endif;?>">
                    <div class="shortest-options-group">
                        <label class="shortest-label" for="shst_es_types">Trigger</label>
                        <select id="shst_es_types" name="shst_es_type" required="required">
                            <option value="<?= Shortest_Monetization::ES_TYPE_CLICK ?>"
                                    <?php if(intval(get_option('shst_es_type')) === Shortest_Monetization::ES_TYPE_CLICK): ?>
                                        selected="selected"
                                    <?php endif;?>>Click
                            </option>
                            <option class="js-timeout" value="<?= Shortest_Monetization::ES_TYPE_TIMEOUT ?>"
                                    <?php if(intval(get_option('shst_es_type')) === Shortest_Monetization::ES_TYPE_TIMEOUT): ?>
                                        selected="selected"
                                    <?php endif;?>>Timeout
                            </option>
                        </select>
                    </div>
                    <div class="js-timeout-opt switcher-visibility <?php if(intval(get_option('shst_es_type')) === Shortest_Monetization::ES_TYPE_TIMEOUT): ?>
                                        active
                                    <?php endif;?>">
                        <div class="shortest-options-group">
                            <label class="shortest-label" for="shst_es_timeout">Timeout (miliseconds)</label>
                            <input type="text" class="shortest-input-text shortest-number" id="shst_es_timeout" name="shst_es_timeout"
                                   value="<?php echo esc_html( get_option('shst_es_timeout') ); ?>"
                                />
                        </div>
                    </div>

                    <div class="shortest-options-group">
                        <h3 class="shortest-header">Capping</h3>
                        <input type="text" class="shortest-capping-input-text shortest-input-text shortest-number" id="shst_es_capping_limit" name="shst_es_capping_limit"
                               value="<?php echo esc_html( get_option('shst_es_capping_limit') ); ?>"
                            />
                        <div class="sep">/</div>
                        <input type="text" class="shortest-capping-input-text shortest-input-text shortest-number" id="shst_es_capping_timeout" name="shst_es_capping_timeout"
                               value="<?php echo esc_html( get_option('shst_es_capping_timeout') ); ?>"
                            />
                        <div class="sep">hours</div>
                    </div>
                </div>
            </div>
            <div class="shortest-settings-group">
                <div class="shortest-options-group">
                    <h2 class="shortest-header">Exits</h2>
                    <div class="shortest-switcher <?php if(get_option('shst_exs_enabled')): ?>active<?php endif;?>" id="switcher09">
                        <div class="switch <?php if(get_option('shst_exs_enabled')): ?>on<?php endif;?>"></div>
                        <input type="checkbox" id="shst_exsenabled" name="shst_exs_enabled" <?php if(get_option('shst_exs_enabled')): ?>checked="checked"<?php endif;?> value="1">
                    </div>
                </div>
            </div>
            <div class="shortest-settings-group">
                <div class="shortest-options-group">
                    <h2 class="shortest-header">Pop Ads</h2>
                    <div class="shortest-switcher <?php if(get_option('shst_pop_enabled')): ?>active<?php endif;?>" id="switcher09">
                        <div class="switch <?php if(get_option('shst_pop_enabled')): ?>on<?php endif;?>"></div>
                        <input type="checkbox" id="shst_popenabled" name="shst_pop_enabled" <?php if(get_option('shst_pop_enabled')): ?>checked="checked"<?php endif;?> value="1">
                    </div>
                </div>
            </div>
            <div class="shortest-settings-group last">
            <input type="hidden" name="shst_email_changed" value="1" />
            <input type="submit" value="Save Changes" class="shortest-submit" id="submit" name="submit">
            </div>
        </form>
    </div>
    <div class="shortest-right">
        <h2 class="shortest-header">Quick help</h2>

        <p class="shortest-paragraph-help">You need a <strong>Shorte.st account</strong> to start earning money. Don't have one? Sign up by clicking the button below.
        <a href="https://shorte.st/register/?utm_source=wordpress&utm_medium=plugin&utm_campaign=plugin" target="_blank" class="shortest-submit">Register on shorte.st</a></p>

        <h3 class="shortest-header">Links</h3>
        <p class="shortest-paragraph-help">Links module monetizes all internal and external links on your website.</p>
        <h3 class="shortest-header">Entries</h3>
        <p class="shortest-paragraph-help">Entries module monetizes all entrances to your website through shorte.st intermediate page.</p>
        <h3 class="shortest-header">Exits</h3>
        <p class="shortest-paragraph-help">Exits module monetizes your bouncing traffic (visitors leaving your website).</p>
        <h3 class="shortest-header">Pop Ads</h3>
        <p class="shortest-paragraph-help">Pop module enables additional ads on your website. These ads show up when a user clicks anywhere on your website and are displayed in a new window under the current browser window. By default, each visitor will see 1 pop ad per 24 hours.</p>
    </div>
</div>
