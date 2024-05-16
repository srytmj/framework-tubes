<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create view v_waktu
        DB::statement("CREATE VIEW v_waktu AS
                        SELECT '2024-01' AS `waktu` UNION 
                        SELECT '2024-02' AS `waktu` UNION 
                        SELECT '2024-03' AS `waktu` UNION 
                        SELECT '2024-04' AS `waktu` UNION 
                        SELECT '2024-05' AS `waktu` UNION 
                        SELECT '2024-06' AS `waktu` UNION 
                        SELECT '2024-07' AS `waktu` UNION 
                        SELECT '2024-08' AS `waktu` UNION 
                        SELECT '2024-09' AS `waktu` UNION 
                        SELECT '2024-10' AS `waktu` UNION 
                        SELECT '2024-11' AS `waktu` UNION 
                        SELECT '2024-12' AS `waktu`");

        // Create view v_waktu_parameter
        DB::statement("CREATE VIEW v_waktu_parameter AS
                        SELECT '01' AS `waktu` UNION 
                        SELECT '02' AS `waktu` UNION 
                        SELECT '03' AS `waktu` UNION 
                        SELECT '04' AS `waktu` UNION 
                        SELECT '05' AS `waktu` UNION 
                        SELECT '06' AS `waktu` UNION 
                        SELECT '07' AS `waktu` UNION 
                        SELECT '08' AS `waktu` UNION 
                        SELECT '09' AS `waktu` UNION 
                        SELECT '10' AS `waktu` UNION 
                        SELECT '11' AS `waktu` UNION 
                        SELECT '12' AS `waktu`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop views if they exist
        DB::statement("DROP VIEW IF EXISTS v_waktu");
        DB::statement("DROP VIEW IF EXISTS v_waktu_parameter");
    }
};
