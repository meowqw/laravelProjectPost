<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use App\Imports\PostsImport;
use App\Models\Post;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from excel ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): void
    {
        int_set('memory_limit', '-1');
        Excel::import(new PostsImport(), 'users.xlsx');

    }
}
