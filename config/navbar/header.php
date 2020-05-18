<?php
/**
 * Supply the basis for the navbar as an array.
 */
$navbarArray = [];
if ($_SESSION) {
    if ($_SESSION["login"] === "admin") {
        $navbarArray = [
            // Use for styling the menu
            "wrapper" => null,
            "class" => "my-navbar rm-default rm-desktop",

            // Here comes the menu items
            "items" => [
                [
                    "text" => "Hem",
                    "url" => "",
                    "title" => "Första sidan, börja här.",
                ],
                [
                    "text" => "Om",
                    "url" => "om",
                    "title" => "Om denna webbplats.",
                ],
                [
                    "text" => "Doc",
                    "url" => "dokumentation",
                    "title" => "Dokumentation av ramverk och liknande.",
                ],
                [
                    "text" => "Produkter",
                    "url" => "products",
                    "title" => "Visa Filmer",
                ],
                [
                    "text" => "Blogg",
                    "url" => "blog",
                    "title" => "blogg-verktyg",
                ],
                [
                    "text" => "Admin",
                    "url" => "admin",
                    "title" => "admin",
                ],
                [
                    "text" => "Logga Ut",
                    "url" => "login/logout",
                    "title" => "logout",
                ],
            ],
        ];
    } elseif ($_SESSION["login"] === "yes") {
        $navbarArray = [
            // Use for styling the menu
            "wrapper" => null,
            "class" => "my-navbar rm-default rm-desktop",

            // Here comes the menu items
            "items" => [
                [
                    "text" => "Hem",
                    "url" => "",
                    "title" => "Första sidan, börja här.",
                ],
                [
                    "text" => "Om",
                    "url" => "om",
                    "title" => "Om denna webbplats.",
                ],
                [
                    "text" => "Doc",
                    "url" => "dokumentation",
                    "title" => "Dokumentation av ramverk och liknande.",
                ],
                [
                    "text" => "Produkter",
                    "url" => "products",
                    "title" => "Visa Filmer",
                ],
                [
                    "text" => "Blogg",
                    "url" => "blog",
                    "title" => "blogg-verktyg",
                ],
                // [
                //     "text" => "Min Sida",
                //     "url" => "user",
                //     "title" => "Min Sida",
                // ],
                [
                    "text" => "Logga Ut",
                    "url" => "login/logout",
                    "title" => "logout",
                ],
            ],
        ];
    }
}  else {
    $navbarArray = [
        // Use for styling the menu
        "wrapper" => null,
        "class" => "my-navbar rm-default rm-desktop",

        // Here comes the menu items
        "items" => [
            [
                "text" => "Hem",
                "url" => "",
                "title" => "Första sidan, börja här.",
            ],
            [
                "text" => "Om",
                "url" => "om",
                "title" => "Om denna webbplats.",
            ],
            [
                "text" => "Doc",
                "url" => "dokumentation",
                "title" => "Dokumentation av ramverk och liknande.",
            ],
            [
                "text" => "Produkter",
                "url" => "products",
                "title" => "Visa Filmer",
            ],
            [
                "text" => "Blogg",
                "url" => "blog",
                "title" => "blogg-verktyg",
            ],
            [
                "text" => "Logga In",
                "url" => "login",
                "title" => "login",
            ],
            // [
            //     "text" => "Admin",
            //     "url" => "admin",
            //     "title" => "admin",
            // ],
        ],
    ];
}


return $navbarArray;
