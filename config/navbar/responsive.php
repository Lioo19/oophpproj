<?php
/**
 * Supply the basis for the navbar as an array.
 */
$login = $_SESSION["login"] ?? null;
if ($login === "admin") {
    return [
        // Use for styling the menu
        "wrapper" => null,
        "class" => "rm-default rm-mobile",

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
                "url" => "doc",
                "title" => "Dokumentation",
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
} elseif ($login === "yes") {
    return [
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

return [
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
