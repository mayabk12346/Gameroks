<?php
/**
 * Represents the view for the public-facing component of the plugin.
 *
 * This typically includes any information, if any, that is rendered to the
 * frontend of the theme when the plugin is activated.
 *
 * @package   Plugin_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2013 Your Name or Company Name
 */
?>

<?php
Shortest_Monetization::get_api_token();
if(get_option('shst_token')): ?>
<script type='text/javascript'>
    var shortest = {};
    shortest.config = {
        token : '<?= get_option('shst_token') ?>'
        <?php if (get_option('shst_fps_enabled')): ?>
            <?php
            $domainsList = get_option('shst_fps_domains_list');
            $domainsList = array_map('trim', explode(",", $domainsList));
            $jsDomainsList = sprintf("['%s']", implode("','", $domainsList));
            if (intval(get_option('shst_fps_selection_type')) === Shortest_Monetization::FPS_SELECTION_TYPE_INCLUDE): ?>
            , domains : <?= $jsDomainsList ?>
            <?php else: ?>
            , excludeDomains : <?= $jsDomainsList ?>
            <?php endif; ?>
            , capping: {
                limit: <?= get_option('shst_fps_capping_limit') ?>,
                time: <?= get_option('shst_fps_capping_timeout') ?>
            }
        <?php endif; ?>
        <?php if (get_option('shst_es_enabled')): ?>
        , entryScript: {
            capping: {
                limit: <?= get_option('shst_es_capping_limit') ?>,
                time: <?= get_option('shst_es_capping_timeout') ?>
            },
            type: '<?= Shortest_Monetization::get_es_type_name(get_option('shst_es_type')) ?>',
            timeout: <?= get_option('shst_es_timeout') ?>
        }
        <?php endif; ?>
        <?php if (get_option('shst_exs_enabled')): ?>
        , exitScript: {
            enabled: true
        }
        <?php endif; ?>
        <?php if (get_option('shst_pop_enabled')): ?>
        , popUnder: {
            enabled: true
        }
        <?php endif; ?>
    };
    (function() {
        var script = document.createElement('script');
        script.async = true;
        script.src = '//cdn.shorte.st/link-converter.min.js';
        var entry = document.getElementsByTagName('script')[0];
        entry.parentNode.insertBefore(script, entry);
    })();
</script>
<?php endif; ?>
