<?php

foreach ($newsRss as $news) {
    echo '<div>';

    echo '<h1>';
    echo '<a href="' . $news->link . '";>';
    echo $news->title;
    echo '</a>';
    echo '</h1>';

    echo '<img
        alt="' . $news->description . '"
        src="' . $news->enclosure->url . '"
    >';
    echo '<p>' . $news->description . '</p>';

    echo '</div>';
}
