<?php

namespace App\Console\Commands;

use App\Services\Parser\YandexParser;
use Illuminate\Console\Command;

class Parser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:client';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var YandexParser $parser
     */
    private $parser;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(YandexParser $yandexParser)
    {
        parent::__construct();

        $this->parser = $yandexParser;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $result = $this->parser->getLinks(file_get_contents('1.html'));

        var_dump($result);
    }
}
