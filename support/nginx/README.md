# Nginx configuration

To install S-Update-Server on nginx you need to copy the file `supdate.conf` in your nginx configuration folder (generally located at `/etc/nginx/site-available`).

I need to change the `server_name` for your website domain name and adapt the `fastcgi_pass` option.

If you want to install S-Update-Server on a sub-folder, use `supdate-alt.conf`.