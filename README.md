# Wordpress Theme for Nacka Equmenia

## Getting Started

Start Docker:

    $ docker compose up

Configure Wordpress on http://localhost:8080

Use some reasonable defaults for a test installation:

* Site Title: Theme Equmenia Scout
* Username: admin
* Password: admin
* Search Engine Visibility: Yes, discourage search engines from indexing this site

Go to http://localhost:8080/wp-admin/themes.php?theme=wp-theme-scouting and activate the theme.

    $ docker-compose exec wordpress sh
    # echo "define('FS_METHOD','direct');" >> wp-config.php
    # chown -R www-data wp-content
    # chmod -R 755 wp-content
    # exit
    
Go to http://localhost:8080/wp-admin/admin.php?import=wordpress and import `test/theme-unit-test-data.xml`