<?php

    // {{}} --> components
    // {} --> parameters

    // Startup variables
    $title = 'Página Inicial';
    $description = 'Somos uma empresa de fotografia e vídeos de Gaspar - SC. Fazemos de tudo um pouquinho, mas focamos em ensaios femininos externos e aniversários infantis.';
    $root_path = './'; // Path relative to the root of the project
                                                                            // Params needed
    $nav = file_get_contents($root_path. "html/components/nav.html"); // {hero_mod} / {title}
    $header = file_get_contents($root_path. "html/components/header.html"); // {root_path} / {1}, {2}, {3}, {4}, {5} --> Active page. Use "active" for activation
    $footer = file_get_contents($root_path. "html/components/footer.html"); // {theme}
    $page = file_get_contents($root_path. "html/template.html"); // {title} / {root_path} / {page_layout} / {{header}} / {{content}} / {{footer}} / {{script}}
    $script = file_get_contents($root_path. "assets/js/script.js");
    $script .= file_get_contents($root_path. "script.js");
    $content = file_get_contents($root_path. "main.html");

    // Custom params
    $hero_mod = "hero--home";
    $page_layout = "home";
    $theme = 'footer--home';
    $active = "active";

    $page = str_replace("{title}", $title, $page);
    $page = str_replace("{description}", $description, $page);
    $page = str_replace("{{nav}}", $nav, $page);
    $title = "MRT Produções";
    $page = str_replace("{{header}}", $header, $page);
    $page = str_replace("{title}", $title, $page);
    $page = str_replace("{{footer}}", $footer, $page);
    $page = str_replace("{{script}}", $script, $page);
    $page = str_replace("{{content}}", $content, $page);
    $page = str_replace("{root_path}", $root_path, $page);
    $page = str_replace("{hero_mod}", $hero_mod, $page);
    $hero_logo = '<img src="assets/img/icons/logo.png" alt="Hero logo" class="hero__img" loading="lazy">';
    $page = str_replace("{hero_logo}", $hero_logo, $page);
    $page = str_replace("{1}", $active, $page);
    $page = str_replace("{page_layout}", $page_layout, $page);

    print($page);

?>
