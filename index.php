<?php 

    // {{}} --> components
    // {} --> parameters

    // Startup variables
    $title = 'Página Inicial';
    $root_path = './'; // Path relative to the root of the project
                                                                            // Params needed
    $nav = file_get_contents($root_path. "html/components/nav.html"); // {hero_mod} / {title}
    $header = file_get_contents($root_path. "html/components/header.html"); // {root_path} / {1}, {2}, {3}, {4}, {5} --> Active page. Use "active" for activation 
    $footer = file_get_contents($root_path. "html/components/footer.html"); // {theme}
    $page = file_get_contents($root_path. "html/template.html"); // {title} / {root_path} / {page_layout} / {{header}} / {{content}} / {{footer}} / {{script}}
    $script = file_get_contents($root_path. "assets/js/script.js");
    $content = file_get_contents($root_path. "main.html");

    // Custom params
    $hero_mod = "hero--home";
    $page_layout = "home";
    $active = "active";

    $page = str_replace("{title}", $title, $page);
    $page = str_replace("{{nav}}", $nav, $page);
    $title = "MRT Produções";
    $page = str_replace("{{header}}", $header, $page);
    $page = str_replace("{title}", $title, $page);
    $page = str_replace("{{footer}}", $footer, $page);
    $page = str_replace("{{script}}", $script, $page);
    $page = str_replace("{{content}}", $content, $page);
    $page = str_replace("{root_path}", $root_path, $page);
    $page = str_replace("{hero_mod}", $hero_mod, $page);
    $page = str_replace("{1}", $active, $page);
    $page = str_replace("{page_layout}", $page_layout, $page);
    
    print($page);

?>