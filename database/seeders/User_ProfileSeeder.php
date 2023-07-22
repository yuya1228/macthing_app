<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User_ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profiles')->insert([
            'id' => 1,
            'image' => 'img_character01.png',
            'user_id' => 1,
            'text' => 'スポンジ・ボブは、パイナップルのお家に住んでいる海綿くん。性格はとっても前向きで楽観的。無邪気で
            何事にも一生懸命。彼のナイスなユーモアと溢れんばかりの善意はなぜか他人をイライラさせてしまう・・・。
            でも、元気一杯の姿はとても憎めない。',
            'age' => 18,
            'hobby' => '料理',
            'gender_id' => 1,
        ]);

        DB::table('profiles')->insert([
            'id' => 2,
            'image' => 'img_character02.png',
            'user_id' => 2,
            'text' => 'スポンジ・ボブの大親友のヒトデのパトリック。怠け者のパトリックは多くの時間を自宅である
            岩の下で過ごす。彼の趣味は、とにかく寝ること。スポンジ・ボブとはお互いに助け合ういい関係。',
            'age' => 18,
            'hobby' => '寝ること',
            'gender_id' => 1,
        ]);

        DB::table('profiles')->insert([
            'id' => 3,
            'image' => 'img_character03.png',
            'user_id' => 3,
            'text' => '名前はイカルドだけど、本当はタコ。性格はイライラしがちで、いつも不機嫌、誰よりも
            自分が素晴らしいと思っている。',
            'age' => 40,
            'hobby' => '楽器',
            'gender_id' => 1,
        ]);

        DB::table('profiles')->insert([
            'id' => 4,
            'image' => 'img_character04.png',
            'user_id' => 4,
            'text' => 'バーガーショップ「カニカーニー」のオーナーであり、スポンジ・ボブの上司でもある。
            お金を稼ぐことと、お金勘定が趣味。',
            'age' => 50,
            'hobby' => 'お金勘定',
            'gender_id' => 1,
        ]);

        DB::table('profiles')->insert([
            'id' => 5,
            'image' => 'img_character05.png',
            'user_id' => 5,
            'text' => 'カーニさんのライバルでもあるプランクトン。体は小さいが、態度はでかい。
            「カニカーニ」のライバル店「エサバケツ亭」のオーナーである。',
            'age' => 30,
            'hobby' => 'レシピ盗み',
            'gender_id' => 1,
        ]);

        DB::table('profiles')->insert([
            'id' => 6,
            'image' => 'img_character06.png',
            'user_id' => 6,
            'text' => 'テキサス出身のリスの女の子、サンディはアドベンチャーやエキサイティングなことが大好き！',
            'age' => 20,
            'hobby' => 'アドベンチャー',
            'gender_id' => 2,
        ]);

        DB::table('profiles')->insert([
            'id' => 7,
            'image' => 'img_character07.png',
            'user_id' => 7,
            'text' => 'スポンジ・ボブのお利口なペット。ネコ科のカタツムリで、ミャ〜オと鳴く。
            スポンジ・ボブのベッドの横で眠り、飼い主にとても忠実。',
            'age' => 3,
            'hobby' => '眠ること',
            'gender_id' => 1,
        ]);
        DB::table('profiles')->insert([
            'id'=>8,
            'image'=>'hitoe9.png',
            'user_id'=>8,
            'text'=>'これはテストです。',
            'age'=>20,
            'hobby'=>'なし',
            'gender_id'=>1,
        ]);
        DB::table('profiles')->insert([
            'id' => 9,
            'image' => 'IMG_0464.jpeg',
            'user_id' => 9,
            'text' => 'これはテストです。',
            'age' => 20,
            'hobby' => 'なし',
            'gender_id' => 1,
        ]);
    }
}
