<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Dates;
use DB;


class GetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:GetData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // DB::table('dates')->delete();
        DB::table('dates')->insert(['start' => "2020-12-01",'end' =>"2020-12-02"]);
        // Dates::create(['start' => "2020-12-01",'end' =>"2020-12-02"]);
        echo "Operation executed";
    }
}
