protected function schedule(Schedule $schedule)
{
    $schedule->command('clear:guest-users')->daily();
}