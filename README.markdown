Generator is simple set of classes to generate dummy data

Usage example:

    <?php
        set_include_path(get_include_path().PATH_SEPARATOR.'./Generate/');
        spl_autoload_register();

        $n = new Generator_Address();
        echo $n->next() . PHP_EOL;

        $n = new Generator_Email();
        echo $n->next() . PHP_EOL;

        $n = new Generator_Url();
        echo $n->next() . PHP_EOL;
    ?>

OR:

    <?php
        require_once 'Generate/generate.php';

        echo Generate::get(Generate::ADDRESS) . PHP_EOL;
        echo Generate::get(Generate::EMAIL) . PHP_EOL;
        echo Generate::get(Generate::URL) . PHP_EOL;
    ?>

Will produce:

    Evanston 84066 94 Ruiz street, Utah
    fnatalie@saku-brewery.net
    http://www.lexmark.biz/euismod-aliquam-feugiat.html