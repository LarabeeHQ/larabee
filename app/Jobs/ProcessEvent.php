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
use App\Models\Event;

use App\Services\Bot;

class ProcessEvent implements ShouldQueue
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

            // if found in cache, revalidate for more 30min
            if (!Cache::has("session:$hash")) {
                return;
            }

            // get session
            $session = Cache::get("session:$hash");

            // create event
            $event = new Event;
            $event->session_id = $session->id;
            $event->website_id = $session->website_id;
            $event->name = $this->data['name'];
            $event->data = $this->data['data'];
            $event->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }
    }
}
