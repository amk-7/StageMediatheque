<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UploadFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $destination_path;
    private $files;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($files, $destination_path)
    {
        $this->files=$files;
        $this->destination_path=$destination_path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->files->file("fileList") as $file){
            $file->storeAs($this->destination_path, $file->getClientOriginalName());
        }
    }
}
