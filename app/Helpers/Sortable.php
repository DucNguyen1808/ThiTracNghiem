<?php

use Hamcrest\Text\SubstringMatcher;

function sortable($field, $sort,$class="text-Minfo")
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
    $html = "<a $url>
                <i class='$icon $class'></i>
            </a>";
    return $html;
}
