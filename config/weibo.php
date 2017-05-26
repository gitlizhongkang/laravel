<?php
return[
 'client_id'=>env("WEIBO_KEY"),
'client_secret'=>env("WEIBO_SECRET"),
'grant_type'=>env("GRANT_TYPE"),
'redirect_uri'=>env("REDIRECT_URI"),
 'auth_uri'=> env("AUTH_URI"),
 'weibo_uri'=> env("WEIBO_URI"),
    'show_uri'=>env("SHOW_URI"),
];
