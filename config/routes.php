<?php

$app->router->get('/', function() {
    echo 'main';
});

$app->router->get('/post', function() {
    echo 'post';
});

$app->router->get('/posts/(?P<slug>[a-z0-9-]+)/?', function() {
    echo 'posts';
});
