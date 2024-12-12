<?php

use Hamcrest\Text\SubstringMatcher;

function sortable($field, $sort)
{

    $sortType = $field == $sort['column'] ? $sort['type'] : 'default';
    $icons = [
        "default" => "fa-solid fa-sort",
        "desc" => "fa-solid fa-arrow-up-wide-short",
        "asc" => "fa-solid fa-arrow-up-short-wide"
    ];
    $types = [
        "default" => "desc",
        "desc" => "asc",
        "asc" => "desc"
    ];
    $icon = $icons[$sortType];
    $type = $types[$sortType];
    $url = e('href=?_sort=true&column=' . $field . '&type=' . $type . '');
    $html = "<a $url class='text-Minfo'>
                <i class='$icon'></i>
            </a>";
    return $html;
}
