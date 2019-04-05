<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Code;
use Overtrue\Pinyin\Pinyin;

class SetSlugForCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $codes = app(Code::class)->all();
        foreach ($codes as $code) {
            $code->slug = app(Pinyin::class)->permalink($code->subject);
            $code->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
