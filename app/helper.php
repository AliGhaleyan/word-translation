<?php

if (!function_exists('generate_pagination_info')) {
    function generate_pagination_info(string $baseUrl, $count, $perPage, string $pagePrefix = "page")
    {
        return [
            "total"        => $count,
            "total_page"   => ceil($count / $perPage),
            "url"          => $baseUrl,
            "current_page" => request()->input('page', 1),
        ];
    }
}
