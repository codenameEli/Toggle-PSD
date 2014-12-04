<?php
// Without this line, it breaks

include_once('updater.php');

if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin

    $config = array(
        'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
        'proper_folder_name' => 'toggle-psd', // this is the name of the folder your plugin lives in
        'api_url' => 'https://api.github.com/repos/codenameEli/Toggle-PSD', // the GitHub API url of your GitHub repo
        'raw_url' => 'https://raw.githubusercontent.com/codenameEli/Toggle-PSD/master/toggle-psd.php', // the GitHub raw url of your GitHub repo
        'github_url' => 'https://github.com/codenameEli/Toggle-PSD', // the GitHub url of your GitHub repo
        'zip_url' => 'https://github.com/codenameEli/Toggle-PSD/zipball/master', // the zip url of the GitHub repo
        'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
        'requires' => '3.0', // which version of WordPress does your plugin require?
        'tested' => '3.3', // which version of WordPress is your plugin tested up to?
        'readme' => 'README.md', // which file to use as the readme for the version number
        'access_token' => '', // Access private repositories by authorizing under Appearance > GitHub Updates when this example plugin is installed
    );

    new WP_GitHub_Updater($config);
}