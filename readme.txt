SHORT README

This is a simple frontend for a mysql movie and tvshow database which was initialized with a kodi mediacenter.

IMPORTANT: No running Kodi instance is needed, only the MySQL-server with the corresponding database must be available!

I know that there are several webinterfaces for kodi itself, but all of them need a running kodi.
I do have two kodi installations on an Amazon FireTV and also on a Raspberry Pi, but they are not online 24/7, so this is the smartest solution I found.
My MySQL Database is running on my NAS where I also host my websites.

Maybe the code will get improved in the next month, but I can not promise anything..

INSTALLATION:

- Clone the Repo to a webspace
- Edit the config.inc.php in the 'functions'-folder
- Open the Website in your browser
- All done!

IMPORTANT:

All the thumbnails on the movie page will be downloaded from imdb, sometimes the download is very slow. Maybe I will implement a possibility to use locally saved thumbnails instead.

Have fun!