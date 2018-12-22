<?php

namespace App\Jobs;

use App\Hadoken;
use App\Submit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Challenge;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class ChallengeAnswer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    protected $challenge;
    protected $answer;
    protected $submit;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($challenge, $answer, $submit)
    {
        $this->challenge = $challenge;
        $this->answer = $answer;
        $this->submit = $submit;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info(
            'Started job to verify answer',
            [
                'id' => $this->submit->id,
                'user_id' => $this->submit->user_id,
                'challenge_id' => $this->challenge->id,
                'answer' => $this->answer,
                'hostname' => gethostname(),
            ]
        );
        $html = $this->challenge['html'];
        $answer = $this->answer;

        $descriptorspec = [
            0 => array("pipe", "r"),
            1 => array("pipe", "w"),
            2 => array("file", "/tmp/error-output.txt", "a"),
        ];

        $cmd = 'timeout -sINT 5s node verify.js';
        $cwd = '/home/worker/app/worker';
        $env = [
            'html' => $html,
            'answer' => $answer,
            'success' => Challenge::$status_verified,
            'fail' => Challenge::$status_failed,
        ];

        $process = proc_open($cmd, $descriptorspec, $pipes, $cwd, $env);

        if (is_resource($process)) {
            $result = rtrim(stream_get_contents($pipes[1]));
            fclose($pipes[1]);

            if ($result === Challenge::$status_verified) {
                $this->challenge->update([
                    'status' => Challenge::$status_solved,
                ]);
            }

            $this->submit->update([
                'status' => $result === '' ? Challenge::$status_error : $result,
            ]);

            if (App::environment('production')) {
                switch ($result) {
                    case Challenge::$status_verified:
                        Hadoken::success($this->submit->from_ip);
                        break;
                    default:
                        Hadoken::fail($this->submit->from_ip);
                        break;
                }
            }

            proc_close($process);
        }

        Log::info(
            'Finished job to verify answer',
            [
                'id' => $this->submit->id,
                'result' => $result,
            ]
        );
    }

    public function retryUntil()
    {
        return now()->addSeconds(10);
    }
}
