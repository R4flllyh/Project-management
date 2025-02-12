<?php

namespace App\Console\Commands;
use App\Notifications\ProjectDeadlineNotification;
use App\Models\Project;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\User;

class SendDeadlineNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-deadline-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deadlineThreshold = Carbon::now()->addDays(3); // Define the deadline threshold (e.g., 3 days before the deadline)
        // Example: Dispatch the notification to a user
        $user = User::where('email')->first();
        $projects = Project::where('due_date', '<=', $deadlineThreshold)->get();

        foreach ($projects as $project) {
            if ($user) {
                $user->notify(new ProjectDeadlineNotification($project));
                $this->info("Notification sent for project ID: {$project->id} to user ID: {$user->id}");
            } else {
                $this->error("User not found for project ID: {$project->id}");
            }
        }

        $this->info('Project deadline notifications sent successfully.');
    }
}
