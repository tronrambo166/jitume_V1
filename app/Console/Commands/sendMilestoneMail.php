<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class sendMilestoneMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:milestone_reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is a milestone due reminder';

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
     * @return int
     */
    public function handle()
    {
        $p = DB::table('price')->where('id',1)->first();
        DB::table('price')->where('id',1)->update(['price' => $p->price+1]);
    }
}
