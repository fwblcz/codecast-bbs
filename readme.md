<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](http://patreon.com/taylorotwell):

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[British Software Development](https://www.britishsoftware.co)**
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Pulse Storm](http://www.pulsestorm.net/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).


## GitHub 上 window版本的Redis-x64-3.2.100.zip 下载没网速 以及安装

- GitHub 上 window版本的Redis-x64-3.2.100.zip 下载没网速，需要上外网，翻墙下载，也可以在百度链接上下载：https://pan.baidu.com/s/1dFJD217;
  打开一个 cmd 窗口 使用cd命令切换目录到 C:\redis 运行 redis-server.exe redis.windows.conf

- redis 启动:
  打开一个命令窗口，进入到你解压的目录，输入命令：redis-server redis.windows.conf

- 部署redis为windows下的服务 命令如下：
  再打开一个新的命令窗口，输入命令：redis-server --service-install redis.windows.conf

- 安装后的启动服务命令：redis-server --service-start
- 停止服务命令：redis-server --service-stop

- redis的卸载命令：redis-server --service-uninstall

- 推荐一个redis的管理工具：Redis Desktop Manager

## 假数据填充
- 在开始开发话题列表之前，我们需要一些假数据来辅助，假数据生成逻辑如下：

- 填充 10 条用户数据，作为话题的作者使用；
- 100 条话题数据，这样我们就能测试分页功能；
- 填充话题时分类随机；
- 填充话题时作者随机

### 一、填充用户数据

  话题数据中需使用『用户数据』作为话题作者，故我们先填充用户数据。

  用户的假数据填充涉及到以下几个文件：

- 数据模型 User.php
- 用户的数据工厂 database/factories/UserFactory.php
- 用户的数据填充 database/seeds/UsersTableSeeder.php
- 注册数据填充 database/seeds/DatabaseSeeder.php
-  数据模型在前面章节中已定制过，此处无需修改，接下来我们从 UserFactory 开始。

1. 用户的数据工厂#
Laravel 框架自带了 UserFactory.php 作为示例文件：

database/factories/UserFactory.php
<pre>
 <?php

 use Faker\Generator as Faker;

 /*
 |--------------------------------------------------------------------------
 | Model Factories
 |--------------------------------------------------------------------------
 |
 | This directory should contain each of the model factory definitions for
 | your application. Factories provide a convenient way to generate new
 | model instances for testing / seeding your application's database.
 |
 */

 $factory->define(App\Models\User::class, function (Faker $faker) {
     static $password;

     return [
         'name' => $faker->name,
         'email' => $faker->unique()->safeEmail,
         'password' => $password ?: $password = bcrypt('secret'),
         'remember_token' => str_random(10),
     ];
 });
</pre>
define 定义了一个指定数据模型（如此例子 User）的模型工厂。define 方法接收两个参数，第一个参数为指定的 Eloquent 模型类，第二个参数为一个闭包函数，该闭包函数接收一个 Faker PHP 函数库的实例，让我们可以在函数内部使用 Faker 方法来生成假数据并为模型的指定字段赋值。

我们需要增加 introduction 用户简介字段的填充，另外我们计划在 UsersTableSeeder 里使用 批量入库 的方式填充数据，因此需要自行填充 created_at 和 updated_at 两个字段。修改后的代码如下：

database/factories/UserFactory.php

<pre>
<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;
    $now = Carbon::now()->toDateTimeString();

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('password'),
        'remember_token' => str_random(10),
        'introduction' => $faker->sentence(),
        'created_at' => $now,
        'updated_at' => $now,
    ];
});
</pre>

Faker 是一个假数据生成库，sentence() 是 faker 提供的 API ，随机生成『小段落』文本。我们用来填充 introduction 个人简介字段。

Carbon 是 PHP DateTime 的一个简单扩展，这里我们使用 now() 和 toDateTimeString() 来创建格式如 2017-10-13 18:42:40 的时间戳。

2. 用户数据填充#
使用以下命令生成数据填充文件：
<pre>
$ php artisan make:seed UsersTableSeeder
</pre>

修改文件如以下：

database/seeds/UsersTableSeeder.php

<pre>
<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png?imageView2/1/w/200/h/200',
        ];

        // 生成数据集合
        $users = factory(User::class)
                        ->times(10)
                        ->make()
                        ->each(function ($user, $index)
                            use ($faker, $avatars)
        {
            // 从头像数组中随机取出一个并赋值
            $user->avatar = $faker->randomElement($avatars);
        });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'Summer';
        $user->email = 'summer@yousails.com';
        $user->avatar = 'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200';
        $user->save();

    }
}
</pre>
代码讲解#
顶部使用 use 关键词引入必要的类。

factory(User::class) 根据指定的 User 生成模型工厂构造器，对应加载 UserFactory.php 中的工厂设置。

times(10) 指定生成模型的数量，此处我们只需要生成 10 个用户数据。

make() 方法会将结果生成为 集合对象。

each() 是 集合对象 提供的 方法，用来迭代集合中的内容并将其传递到回调函数中。

use 是 PHP 中匿名函数提供的本地变量传递机制，匿名函数中必须通过 use 声明的引用，才能使用本地变量。

makeVisible() 是 Eloquent 对象提供的方法，可以显示 User 模型 $hidden 属性里指定隐藏的字段，此操作确保入库时数据库不会报错。

3. 注册数据填充#
先去掉 $this->call(UsersTableSeeder::class); 的注释，还要注释掉我们还未开发 TopicsTableSeeder 调用：

database/seeds/DatabaseSeeder.php

<pre>
<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        // $this->call(TopicsTableSeeder::class);
    }
}
</pre>

4. 测试一下#
使用以下命令运行迁移文件：
<pre>
$ php artisan db:seed
</pre>

能看到我们成功生成的数据，不过发现存在 阿萨德 和 test 等测试数据，我们并不想要这些数据。我们需要能删除 users 表数据，并重新生成填充数据的命令：

<pre>
$ php artisan migrate:refresh --seed
</pre>

Laravel 的 migrate:refresh 命令会回滚数据库的所有迁移，并运行 migrate 命令，--seed 选项会同时运行 db:seed 命令。


## 启动elasticsearch
<pre>
C:\>cd elasticsearch-rtf-master

C:\elasticsearch-rtf-master>cd bin

C:\elasticsearch-rtf-master\bin>elasticsearch -d
</pre>

