<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //esto desactiva las llaves foraneas y permite ejecutar el seeder sin vaciar manualmente la base de datos
        //por q elimina todos los registros
        $this->truncateTable(array(
            'users',
            'password_resets',
            'tickets',
            'ticket_comments',
            'ticket_votes'
        ));
        $this->call(UsersTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
        $this->call(TicketVoteTableSeeder::class);
        $this->call(TicketCommentTableSeeder::class);
    }

    private function truncateTable($tables)
    {
        $this->checkForeignKeys(false);
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        $this->checkForeignKeys(true);
    }

    private function checkForeignKeys($check)
    {
        $check = $check ? '1' : '0';
        DB::statement("SET FOREIGN_KEY_CHECKS = $check;");
    }
}
