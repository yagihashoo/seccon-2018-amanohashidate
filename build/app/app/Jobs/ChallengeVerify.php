<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Challenge;
use Illuminate\Support\Facades\Log;

class ChallengeVerify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    protected $challenge;
    protected $answer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($challenge_id, $answer)
    {
        $this->challenge = Challenge::findOrFail($challenge_id);
        $this->answer = $answer;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info(
            'Started job to verify challenge',
            [
                'id' => $this->challenge->id,
                'setter_id' => $this->challenge->setter_id,
                'model_answer' => $this->challenge->model_answer,
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

            $this->challenge->update([
                'status' => $result === '' ? Challenge::$status_error : $result,
            ]);

            proc_close($process);
        }

        Log::info(
            'Finished job to verify challenge',
            [
                'id' => $this->challenge->id,
                'result' => $result,
            ]
        );
    }

    public function retryUntil()
    {
        return now()->addSeconds(10);
    }
}
