<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Matter;

class UpdateRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update specific records in the table daily at midnight';

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
//         Matter::where('matter_type',8)->update(['user_id' => '0']);
        Matter::where('matter_type',8)->update(['hour1' => '10']);
        $this->info('Records updated successfully.');
    }
}
