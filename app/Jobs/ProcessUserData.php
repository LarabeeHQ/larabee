<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use App\Models\Session;

use App\Services\Bot;

class ProcessUserData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public $website;

    public $bot;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $website)
    {
        $this->data = $data;
        $this->website = $website;
        $this->bot = new Bot;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::beginTransaction();

        try {

            if ($this->bot->isBot($this->data['user_agent'])) {
                return;
            }

            // redis cache key
            $hash = Session::generateHash(
                $this->website['id'],
                $this->data['hostname'],
                $this->data['ip'],
                $this->data['user_agent']
            );

            if (!Cache::has("session:$hash")) {
                return;
            }

            $session = Cache::get("session:$hash");
            $session->name = isset($this->data['user']['name'] ) ? $this->data['user']['name'] : null;
            $session->email = isset($this->data['user']['email'] ) ? $this->data['user']['email'] : null;
            $session->unique_id = isset($this->data['user']['id'] ) ? $this->data['user']['id'] : null;
            $session->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }
    }
}
